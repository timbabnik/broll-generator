<?php

namespace App\Jobs;

use App\Models\Asset;
use App\Models\Sentence;
use App\Services\SeedanceService;
use App\Services\SeedreamService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class GenerateMediaJob implements ShouldQueue
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
            $seedreamService = app(SeedreamService::class);
            $seedanceService = app(SeedanceService::class);

            // Generate image
            $imageResult = $seedreamService->generateImage($this->sentence->image_prompt);
            
            if ($imageResult['success']) {
                Asset::create([
                    'sentence_id' => $this->sentence->id,
                    'type' => 'image',
                    'url' => $imageResult['url'],
                    'metadata' => $imageResult['metadata'],
                    'status' => 'completed'
                ]);
            } else {
                Log::error('Image generation failed', [
                    'sentence_id' => $this->sentence->id,
                    'error' => $imageResult['error'] ?? 'Unknown error'
                ]);
            }

            // Generate video (with image reference if available)
            $imageUrl = $imageResult['success'] ? $imageResult['url'] : null;
            $videoResult = $seedanceService->generateVideo($this->sentence->video_prompt, $imageUrl);
            
            if ($videoResult['success']) {
                Asset::create([
                    'sentence_id' => $this->sentence->id,
                    'type' => 'video',
                    'url' => $videoResult['url'],
                    'metadata' => $videoResult['metadata'],
                    'status' => 'completed'
                ]);
            } else {
                Log::error('Video generation failed', [
                    'sentence_id' => $this->sentence->id,
                    'error' => $videoResult['error'] ?? 'Unknown error'
                ]);
            }

            // Check if script is complete
            $this->checkScriptCompletion();

            Log::info('Media generation completed', [
                'sentence_id' => $this->sentence->id,
                'image_success' => $imageResult['success'],
                'video_success' => $videoResult['success']
            ]);

        } catch (\Exception $e) {
            Log::error('Media generation failed', [
                'sentence_id' => $this->sentence->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw $e;
        }
    }

    /**
     * Check if all sentences in the script are processed
     */
    private function checkScriptCompletion(): void
    {
        $script = $this->sentence->script;
        $totalSentences = $script->sentences()->count();
        $completedSentences = $script->sentences()
            ->whereHas('assets', function ($query) {
                $query->where('status', 'completed');
            })
            ->count();

        if ($completedSentences >= $totalSentences) {
            $script->update(['status' => 'completed']);
        }
    }
}
