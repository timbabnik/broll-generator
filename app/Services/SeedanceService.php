<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SeedanceService
{
    private string $apiKey;
    private string $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.fal.api_key');
        $this->baseUrl = config('services.fal.base_url', 'https://fal.run');
    }

    /**
     * Generate video from enhanced prompt and generated image using fal.ai Seedance
     */
    public function generateVideo(string $enhancedVideoPrompt, string $imageUrl, int $duration = 3): array
    {
        try {
            $payload = [
                'prompt' => $enhancedVideoPrompt,
                'image_url' => $imageUrl,
                'duration' => $duration,
                'resolution' => '480p', // Lower resolution for cheaper cost
                'enable_safety_checker' => false,
            ];

            $response = Http::withHeaders([
                'Authorization' => 'Key ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(120)->post($this->baseUrl . '/fal-ai/bytedance/seedance/v1/lite/image-to-video', $payload);

            if ($response->successful()) {
                $data = $response->json();
                
                return [
                    'success' => true,
                    'url' => $data['video']['url'] ?? null,
                    'task_id' => $data['request_id'] ?? null,
                    'metadata' => [
                        'model' => 'seedance',
                        'duration' => 3,
                        'fps' => 24,
                        'aspect_ratio' => '16:9',
                        'enhanced_video_prompt' => $enhancedVideoPrompt,
                        'image_url' => $imageUrl,
                        'response' => $data
                    ]
                ];
            }

            Log::error('fal.ai Seedance API error', [
                'status' => $response->status(),
                'response' => $response->body()
            ]);

            return [
                'success' => false,
                'error' => 'API request failed',
                'details' => $response->body()
            ];

        } catch (\Exception $e) {
            Log::error('fal.ai Seedance API exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Check video generation status
     */
    public function checkVideoStatus(string $taskId): array
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Key ' . $this->apiKey,
            ])->get($this->baseUrl . '/videos/' . $taskId);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'data' => $response->json()
                ];
            }

            return [
                'success' => false,
                'error' => 'Failed to check status'
            ];

        } catch (\Exception $e) {
            Log::error('fal.ai Seedance status check exception', [
                'message' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}
