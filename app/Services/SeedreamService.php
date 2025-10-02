<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SeedreamService
{
    private string $apiKey;
    private string $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.fal.api_key');
        $this->baseUrl = config('services.fal.base_url', 'https://fal.run');
    }

    /**
     * Generate image from prompt using Seedream v4
     */
    public function generateImage(string $prompt): array
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Key ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl . '/fal-ai/bytedance/seedream/v4/text-to-image', [
                'prompt' => $prompt,
                'image_size' => 'square_hd',
                'num_inference_steps' => 28,
                'enable_safety_checker' => true,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                return [
                    'success' => true,
                    'url' => $data['images'][0]['url'] ?? null,
                    'metadata' => [
                        'model' => 'seedream-v4',
                        'size' => 'square_hd',
                        'prompt' => $prompt,
                        'response' => $data
                    ]
                ];
            }

            Log::error('fal.ai Seedream API error', [
                'status' => $response->status(),
                'response' => $response->body()
            ]);

            return [
                'success' => false,
                'error' => 'API request failed',
                'details' => $response->body()
            ];

        } catch (\Exception $e) {
            Log::error('fal.ai Seedream API exception', [
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
     * Check image generation status
     */
    public function checkImageStatus(string $taskId): array
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Key ' . $this->apiKey,
            ])->get($this->baseUrl . '/images/' . $taskId);

            if ($response->successful()) {
                return $response->json();
            }

            return [
                'success' => false,
                'error' => 'Failed to check status'
            ];

        } catch (\Exception $e) {
            Log::error('fal.ai Seedream status check exception', [
                'message' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}