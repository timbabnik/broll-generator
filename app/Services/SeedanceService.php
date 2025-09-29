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
        $this->apiKey = config('services.seedance.api_key');
        $this->baseUrl = config('services.seedance.base_url', 'https://api.seedance.ai/v1');
    }

    /**
     * Generate video from prompt
     */
    public function generateVideo(string $prompt, ?string $imageUrl = null): array
    {
        try {
            $payload = [
                'prompt' => $prompt,
                'model' => 'runway-gen3',
                'duration' => 5, // 5 seconds default
                'quality' => 'hd',
            ];

            // If image URL provided, use it as reference
            if ($imageUrl) {
                $payload['image_url'] = $imageUrl;
            }

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl . '/videos/generate', $payload);

            if ($response->successful()) {
                $data = $response->json();
                
                return [
                    'success' => true,
                    'url' => $data['data'][0]['url'] ?? null,
                    'task_id' => $data['task_id'] ?? null,
                    'metadata' => [
                        'model' => 'runway-gen3',
                        'duration' => 5,
                        'quality' => 'hd',
                        'prompt' => $prompt,
                        'image_url' => $imageUrl,
                        'response' => $data
                    ]
                ];
            }

            Log::error('Seedance API error', [
                'status' => $response->status(),
                'response' => $response->body()
            ]);

            return [
                'success' => false,
                'error' => 'API request failed',
                'details' => $response->body()
            ];

        } catch (\Exception $e) {
            Log::error('Seedance API exception', [
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
