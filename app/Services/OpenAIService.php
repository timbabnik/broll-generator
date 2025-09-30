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
        $prompt = "You are a precise script analyst. I will give you a script, and you will break it down sentence by sentence.\n\nFormat your response as a JSON array like this:\n\n[\n  {\"sentence\": 1, \"text\": \"First sentence of the script\"},\n  {\"sentence\": 2, \"text\": \"Next sentence\"},\n  ...\n]\n\nScript:\n" . $script;

        $response = $this->makeRequest($prompt);
        
        if (!$response) {
            throw new \Exception('Failed to split script into sentences');
        }

        // Try to decode JSON response
        $decoded = json_decode($response, true);
        
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return $decoded;
        }
        
        // If not JSON, split by sentences manually
        $sentences = preg_split('/[.!?]+/', $script);
        $sentences = array_filter(array_map('trim', $sentences));
        
        return array_values($sentences);
    }

    /**
     * Generate shotlist for a sentence
     */
    public function generateShotlist(string $sentence): array
    {
        $prompt = "Break down this script sentence into 2-4 distinct visual moments, each focusing on a different part of the action:\"" . $sentence . "\"\n\nFormat your response as a JSON array like this:\n\n[\n  {\"second\": 0, \"script\": \"First part of the sentence\", \"shot\": \"Visual description (shot) in 25 words or more\"},\n  {\"second\": 1, \"script\": \"Second part of the sentence\", \"shot\": \"Visual description (shot) in 25 words or more\"},\n  ...\n]\n\nIMPORTANT: Break the sentence into meaningful parts (like 'pausing to watch' then 'the rain fall' then 'in silence'). Don't repeat the entire sentence for each second.";

        $response = $this->makeRequest($prompt);
        
        if (!$response) {
            throw new \Exception('Failed to generate shotlist');
        }

        // Try to decode JSON response
        $decoded = json_decode($response, true);
        
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return $decoded;
        }
        
        // If not JSON, return the raw response as a single item
        return [['second' => 0, 'script' => $sentence, 'shot' => $response]];
    }

    /**
     * Enhance shotlist into rich image prompt
     */
    public function enhanceToImagePrompt(string $shotlist): string
    {
        $prompt = "Shotlist:\n" . $shotlist . "\n\nRewrite the above shot as if you are a direct response video director and cinematographer who has created 1000+ clickbait, emotional, high-converting video ads for European women over 40.\n\nBring out as much emotion, intimacy, and realism as possible while keeping the same structure.\n\nOutput should be only a prompt for first frame image generation for Seedream v4 image model.";

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
        $prompt = "This is shot description: \"" . $shotlist . "\"\n\nThis is first frame image prompt from the shot: \"" . $imagePrompt . "\"\n\nImage generated with image prompt above will be used as a first frame for image to video generation with model Seedance v1 lite.\n\nNow make prompt for Seedance v1 lite that will bring to life the image.\n\nBring out as much emotion, intimacy, and realism as possible while keeping the same structure.\n\nOutput should be only a prompt for video for Seedance v1 lite image to video model.";

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
