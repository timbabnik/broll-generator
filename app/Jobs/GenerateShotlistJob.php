<?php

namespace App\Jobs;

use App\Models\Sentence;
use App\Services\OpenAIService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class GenerateShotlistJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private Sentence $sentence
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $this->sentence->update(['status' => 'processing']);

            $openAIService = app(OpenAIService::class);
            $shotlist = $openAIService->generateShotlist($this->sentence->original_sentence);

            if (empty($shotlist)) {
                throw new \Exception('Failed to generate shotlist');
            }

            $this->sentence->update([
                'shotlist' => json_encode($shotlist),
                'status' => 'completed'
            ]);

            // Dispatch prompt enhancement for this sentence
            EnhancePromptsJob::dispatch($this->sentence);

            Log::info('Shotlist generated successfully', [
                'sentence_id' => $this->sentence->id
            ]);

        } catch (\Exception $e) {
            $this->sentence->update(['status' => 'failed']);
            
            Log::error('Shotlist generation failed', [
                'sentence_id' => $this->sentence->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw $e;
        }
    }
}
