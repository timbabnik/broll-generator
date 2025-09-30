<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FalAIVideoService
{
    private string $apiKey;
    private string $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.fal.api_key');
        $this->baseUrl = config('services.fal.base_url', 'https://fal.run');
    }

    /**
     * Generate video from prompt using fal.ai
     */
    public function generateVideo(string $prompt, ?string $imageUrl = null): array
    {
        try {
            $payload = [
                'prompt' => $prompt,
                'duration' => 5, // 5 seconds default
                'fps' => 24,
                'aspect_ratio' => '16:9',
                'seed' => null, // Optional seed for reproducibility
            ];

            // If image URL provided, use it as reference
            if ($imageUrl) {
                $payload['image_url'] = $imageUrl;
            }

            $response = Http::withHeaders([
                'Authorization' => 'Key ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl . '/fal-ai/seedance', $payload);

            if ($response->successful()) {
                $data = $response->json();
                
                return [
                    'success' => true,
                    'url' => $data['video']['url'] ?? null,
                    'task_id' => $data['request_id'] ?? null,
                    'metadata' => [
                        'model' => 'seedance',
                        'duration' => 5,
                        'fps' => 24,
                        'aspect_ratio' => '16:9',
                        'prompt' => $prompt,
                        'image_url' => $imageUrl,
                        'response' => $data
                    ]
                ];
            }

            Log::error('fal.ai API error', [
                'status' => $response->status(),
                'response' => $response->body()
            ]);

            return [
                'success' => false,
                'error' => 'API request failed',
                'details' => $response->body()
            ];

        } catch (\Exception $e) {
            Log::error('fal.ai API exception', [
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
                'Authorization' => 'Bearer ' . $this->apiKey,
            ])->get($this->baseUrl . '/videos/' . $taskId);

            if ($response->successful()) {
                return $response->json();
            }

            return [
                'success' => false,
                'error' => 'Failed to check status'
            ];

        } catch (\Exception $e) {
            Log::error('Seedance status check exception', [
                'message' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}
