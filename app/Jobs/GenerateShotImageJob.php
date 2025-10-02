<?php

namespace App\Jobs;

use App\Models\Asset;
use App\Models\Sentence;
use App\Services\SeedreamService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class GenerateShotImageJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private Sentence $sentence,
        private array $shotData,
        private int $shotIndex
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $seedreamService = app(SeedreamService::class);
            
            // Generate image using the enhanced image prompt
            $imageResult = $seedreamService->generateImage($this->shotData['image_prompt']);
            
            if ($imageResult['success']) {
                Asset::create([
                    'sentence_id' => $this->sentence->id,
                    'type' => 'image',
                    'url' => $imageResult['url'],
                    'metadata' => array_merge($imageResult['metadata'], [
                        'shot_index' => $this->shotIndex,
                        'script_part' => $this->shotData['script'],
                        'original_shot' => $this->shotData['shot'],
                        'image_prompt' => $this->shotData['image_prompt']
                    ]),
                    'status' => 'completed'
                ]);

                Log::info('Shot image generated successfully', [
                    'sentence_id' => $this->sentence->id,
                    'shot_index' => $this->shotIndex,
                    'url' => $imageResult['url']
                ]);
            } else {
                Log::error('Shot image generation failed', [
                    'sentence_id' => $this->sentence->id,
                    'shot_index' => $this->shotIndex,
                    'error' => $imageResult['error'] ?? 'Unknown error'
                ]);
            }

        } catch (\Exception $e) {
            Log::error('Shot image generation failed', [
                'sentence_id' => $this->sentence->id,
                'shot_index' => $this->shotIndex,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw $e;
        }
    }
}
