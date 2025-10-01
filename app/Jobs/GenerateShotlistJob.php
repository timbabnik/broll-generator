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

            // Enhance each shot with image prompts
            $enhancedShots = [];
            foreach ($shotlist as $shot) {
                try {
                    $enhancedImagePrompt = $openAIService->enhanceToImagePrompt($shot['shot']);
                    $enhancedShots[] = [
                        'second' => $shot['second'],
                        'script' => $shot['script'],
                        'shot' => $shot['shot'],
                        'image_prompt' => $enhancedImagePrompt
                    ];
                } catch (\Exception $e) {
                    // If enhancement fails, keep the original shot
                    $enhancedShots[] = [
                        'second' => $shot['second'],
                        'script' => $shot['script'],
                        'shot' => $shot['shot'],
                        'image_prompt' => $shot['shot'] // Fallback to original
                    ];
                }
            }

            $this->sentence->update([
                'shotlist' => json_encode($enhancedShots),
                'status' => 'completed'
            ]);

            // Check if all sentences in the script are completed
            $this->checkScriptCompletion();

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

    /**
     * Check if all sentences in the script are completed
     */
    private function checkScriptCompletion(): void
    {
        $script = $this->sentence->script;
        $totalSentences = $script->sentences()->count();
        $completedSentences = $script->sentences()
            ->where('status', 'completed')
            ->count();

        if ($completedSentences >= $totalSentences) {
            $script->update(['status' => 'completed']);
        }
    }
}
