<?php

namespace App\Jobs;

use App\Models\Asset;
use App\Models\Sentence;
use App\Services\SeedanceService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class GenerateVideoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Asset $imageAsset,
        public int $duration = 5
    ) {}

    public function handle(SeedanceService $seedanceService): void
    {
        try {
            // Get the sentence and its shotlist data
            $sentence = $this->imageAsset->sentence;
            
            if (!$sentence || !$sentence->shotlist) {
                Log::error('GenerateVideoJob: Missing shotlist for sentence', [
                    'sentence_id' => $sentence?->id,
                    'image_asset_id' => $this->imageAsset->id
                ]);
                
                $this->imageAsset->update(['status' => 'failed']);
                return;
            }

            // Get the shot index from the image asset metadata
            $metadata = is_string($this->imageAsset->metadata) ? json_decode($this->imageAsset->metadata, true) : $this->imageAsset->metadata;
            $shotIndex = $metadata['shot_index'] ?? null;
            
            if ($shotIndex === null) {
                Log::error('GenerateVideoJob: Missing shot index in image asset metadata', [
                    'sentence_id' => $sentence->id,
                    'image_asset_id' => $this->imageAsset->id,
                    'metadata' => $metadata
                ]);
                
                $this->imageAsset->update(['status' => 'failed']);
                return;
            }

            // Get the video prompt from the shotlist data
            $shotlistData = json_decode($sentence->shotlist, true);
            $shot = $shotlistData[$shotIndex] ?? null;
            
            if (!$shot || !isset($shot['video_prompt'])) {
                Log::error('GenerateVideoJob: Missing video prompt in shotlist', [
                    'sentence_id' => $sentence->id,
                    'image_asset_id' => $this->imageAsset->id,
                    'shot_index' => $shotIndex,
                    'shot' => $shot
                ]);
                
                $this->imageAsset->update(['status' => 'failed']);
                return;
            }

            // Update image asset status to processing
            $this->imageAsset->update(['status' => 'processing']);

            // Generate video using Seedance
            $result = $seedanceService->generateVideo(
                $shot['video_prompt'],
                $this->imageAsset->url,
                $this->duration
            );

            if ($result['success']) {
                // Create video asset
                $videoAsset = Asset::create([
                    'sentence_id' => $sentence->id,
                    'type' => 'video',
                    'url' => $result['url'],
                    'filename' => basename($result['url']),
                    'metadata' => $result['metadata'],
                    'status' => 'completed'
                ]);

                Log::info('GenerateVideoJob: Video generated successfully', [
                    'sentence_id' => $sentence->id,
                    'image_asset_id' => $this->imageAsset->id,
                    'video_asset_id' => $videoAsset->id,
                    'video_url' => $result['url']
                ]);

            } else {
                Log::error('GenerateVideoJob: Video generation failed', [
                    'sentence_id' => $sentence->id,
                    'image_asset_id' => $this->imageAsset->id,
                    'error' => $result['error'] ?? 'Unknown error'
                ]);

                $this->imageAsset->update(['status' => 'failed']);
            }

        } catch (\Exception $e) {
            Log::error('GenerateVideoJob: Exception occurred', [
                'image_asset_id' => $this->imageAsset->id,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            $this->imageAsset->update(['status' => 'failed']);
        }
    }
}
