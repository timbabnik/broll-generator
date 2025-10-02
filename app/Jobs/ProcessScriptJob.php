<?php

namespace App\Jobs;

use App\Jobs\GenerateShotlistJob;
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
            foreach ($sentences as $index => $sentenceData) {
                // Handle both old format (string) and new format (object with text field)
                $sentenceText = is_array($sentenceData) && isset($sentenceData['text']) 
                    ? $sentenceData['text'] 
                    : $sentenceData;
                
                Sentence::create([
                    'script_id' => $this->script->id,
                    'original_sentence' => $sentenceText,
                    'order_index' => $index,
                    'status' => 'pending'
                ]);
            }

            // DON'T dispatch shotlist generation - let the user control it with the Next button
            Log::info('ProcessScriptJob completed - only split sentences, no other jobs dispatched', [
                'script_id' => $this->script->id,
                'sentences_count' => count($sentences)
            ]);

            // Update script status to processing (will be completed when all shotlists are done)
            $this->script->update(['status' => 'processing']);

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
