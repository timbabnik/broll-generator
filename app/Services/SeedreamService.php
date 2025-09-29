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
        $this->apiKey = config('services.seedream.api_key');
        $this->baseUrl = config('services.seedream.base_url', 'https://api.seedream.ai/v1');
    }

    /**
     * Generate image from prompt
     */
    public function generateImage(string $prompt): array
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl . '/images/generate', [
                'prompt' => $prompt,
                'model' => 'stable-diffusion-xl',
                'size' => '1024x1024',
                'quality' => 'hd',
                'n' => 1,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                return [
                    'success' => true,
                    'url' => $data['data'][0]['url'] ?? null,
                    'metadata' => [
                        'model' => 'stable-diffusion-xl',
                        'size' => '1024x1024',
                        'quality' => 'hd',
                        'prompt' => $prompt,
                        'response' => $data
                    ]
                ];
            }

            Log::error('Seedream API error', [
                'status' => $response->status(),
                'response' => $response->body()
            ]);

            return [
                'success' => false,
                'error' => 'API request failed',
                'details' => $response->body()
            ];

        } catch (\Exception $e) {
            Log::error('Seedream API exception', [
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
                'Authorization' => 'Bearer ' . $this->apiKey,
            ])->get($this->baseUrl . '/images/' . $taskId);

            if ($response->successful()) {
                return $response->json();
            }

            return [
                'success' => false,
                'error' => 'Failed to check status'
            ];

        } catch (\Exception $e) {
            Log::error('Seedream status check exception', [
                'message' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}
