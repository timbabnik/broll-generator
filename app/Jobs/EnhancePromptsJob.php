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

            // Generate image prompt from shotlist
            $imagePrompt = $openAIService->enhanceToImagePrompt(json_encode($shotlistData));
            
            if (empty($imagePrompt)) {
                throw new \Exception('Failed to generate image prompt');
            }

            // Generate video prompt from shotlist and image prompt
            $videoPrompt = $openAIService->enhanceToVideoPrompt(json_encode($shotlistData), $imagePrompt);
            
            if (empty($videoPrompt)) {
                throw new \Exception('Failed to generate video prompt');
            }

            $this->sentence->update([
                'image_prompt' => $imagePrompt,
                'video_prompt' => $videoPrompt
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
