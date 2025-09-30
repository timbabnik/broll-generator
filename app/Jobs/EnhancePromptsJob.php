<?php

namespace App\Jobs;

use App\Models\Sentence;
use App\Services\OpenAIService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class EnhancePromptsJob implements ShouldQueue
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
            $openAIService = app(OpenAIService::class);

            // Parse the shotlist JSON
            $shotlistData = json_decode($this->sentence->shotlist, true);
            if (!$shotlistData) {
                throw new \Exception('Invalid shotlist data');
            }

            // Process each shot in the shotlist
            $enhancedShots = [];
            foreach ($shotlistData as $shot) {
                // Generate enhanced image prompt for this individual shot
                $enhancedImagePrompt = $openAIService->enhanceToImagePrompt($shot['shot']);
                
                if (empty($enhancedImagePrompt)) {
                    throw new \Exception('Failed to generate image prompt for shot');
                }

                // Generate video prompt for this shot
                $enhancedVideoPrompt = $openAIService->enhanceToVideoPrompt($shot['shot'], $enhancedImagePrompt);
                
                if (empty($enhancedVideoPrompt)) {
                    throw new \Exception('Failed to generate video prompt for shot');
                }

                $enhancedShots[] = [
                    'second' => $shot['second'],
                    'script' => $shot['script'],
                    'shot' => $shot['shot'],
                    'image_prompt' => $enhancedImagePrompt,
                    'video_prompt' => $enhancedVideoPrompt
                ];
            }

            $this->sentence->update([
                'image_prompt' => json_encode($enhancedShots),
                'video_prompt' => json_encode($enhancedShots)
            ]);

            // Dispatch media generation for this sentence
            GenerateMediaJob::dispatch($this->sentence);

            Log::info('Prompts enhanced successfully', [
                'sentence_id' => $this->sentence->id
            ]);

        } catch (\Exception $e) {
            $this->sentence->update(['status' => 'failed']);
            
            Log::error('Prompt enhancement failed', [
                'sentence_id' => $this->sentence->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw $e;
        }
    }
}
