<?php

namespace App\Jobs;

use App\Models\Script;
use App\Models\Sentence;
use App\Services\OpenAIService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ProcessScriptJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private Script $script
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $this->script->update(['status' => 'processing']);

            $openAIService = app(OpenAIService::class);
            $sentences = $openAIService->splitIntoSentences($this->script->content);

            if (empty($sentences)) {
                throw new \Exception('Failed to split script into sentences');
            }

            // Create sentence records
            foreach ($sentences as $index => $sentence) {
                Sentence::create([
                    'script_id' => $this->script->id,
                    'original_sentence' => $sentence,
                    'order_index' => $index,
                    'status' => 'pending'
                ]);
            }

            // Dispatch shotlist generation for each sentence
            $this->script->sentences()->each(function ($sentence) {
                GenerateShotlistJob::dispatch($sentence);
            });

            Log::info('Script processed successfully', [
                'script_id' => $this->script->id,
                'sentences_count' => count($sentences)
            ]);

        } catch (\Exception $e) {
            $this->script->update(['status' => 'failed']);
            
            Log::error('Script processing failed', [
                'script_id' => $this->script->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw $e;
        }
    }
}
