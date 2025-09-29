<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenAIService
{
    private string $apiKey;
    private string $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.openai.api_key');
        $this->baseUrl = config('services.openai.base_url', 'https://api.openai.com/v1');
    }

    /**
     * Split script into sentences
     */
    public function splitIntoSentences(string $script): array
    {
        $prompt = "Split the following script into individual sentences. Return only a JSON array of sentences, no other text:\n\n" . $script;

        $response = $this->makeRequest($prompt);
        
        if (!$response) {
            throw new \Exception('Failed to split script into sentences');
        }

        return $response;
    }

    /**
     * Generate shotlist for a sentence
     */
    public function generateShotlist(string $sentence): string
    {
        $prompt = "Create a detailed shotlist for this sentence, broken down by seconds. Include camera angles, movements, and visual elements. Be specific about timing:\n\n" . $sentence;

        $response = $this->makeRequest($prompt);
        
        if (!$response) {
            throw new \Exception('Failed to generate shotlist');
        }

        return $response;
    }

    /**
     * Enhance shotlist into rich image prompt
     */
    public function enhanceToImagePrompt(string $shotlist): string
    {
        $prompt = "Convert this shotlist into a rich, detailed image prompt for AI image generation. Include style, lighting, composition, and visual details:\n\n" . $shotlist;

        $response = $this->makeRequest($prompt);
        
        if (!$response) {
            throw new \Exception('Failed to enhance shotlist to image prompt');
        }

        return $response;
    }

    /**
     * Enhance shotlist and image prompt into video prompt
     */
    public function enhanceToVideoPrompt(string $shotlist, string $imagePrompt): string
    {
        $prompt = "Create a detailed video generation prompt based on this shotlist and image prompt. Include camera movements, transitions, timing, and visual effects:\n\nShotlist:\n" . $shotlist . "\n\nImage Prompt:\n" . $imagePrompt;

        $response = $this->makeRequest($prompt);
        
        if (!$response) {
            throw new \Exception('Failed to enhance to video prompt');
        }

        return $response;
    }

    /**
     * Make API request to OpenAI
     */
    private function makeRequest(string $prompt): ?string
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl . '/chat/completions', [
                'model' => 'gpt-4',
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $prompt
                    ]
                ],
                'max_tokens' => 2000,
                'temperature' => 0.7,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return $data['choices'][0]['message']['content'] ?? null;
            }

            Log::error('OpenAI API error', [
                'status' => $response->status(),
                'response' => $response->body()
            ]);

            return null;

        } catch (\Exception $e) {
            Log::error('OpenAI API exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return null;
        }
    }
}
