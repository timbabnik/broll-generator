<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoogleVeoGenerator extends Component
{
    public $prompt = '';
    public $generatedVideo = null;
    public $loading = false;
    public $error = null;
    public $apiKey = '';
    
    protected $rules = [
        'prompt' => 'required|string|max:500',
        'apiKey' => 'required|string'
    ];

    public function mount()
    {
        // You can set a default API key from config or env
        $this->apiKey = config('services.google.veo_api_key', '');
    }

    public function generateVideo()
    {
        $this->validate();
        
        $this->loading = true;
        $this->error = null;
        $this->generatedVideo = null;

        try {
            // Using actual Google Veo 3 through Vertex AI
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->post('https://us-central1-aiplatform.googleapis.com/v1/projects/YOUR_PROJECT_ID/locations/us-central1/publishers/google/models/veo-3.0-generate-001:predictLongRunning', [
                'instances' => [
                    [
                        'prompt' => $this->prompt,
                        'duration' => 5, // seconds
                        'quality' => 'high',
                        'aspect_ratio' => '16:9'
                    ]
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                // For long-running operations, we get an operation name
                if (isset($data['name'])) {
                    $this->error = 'Video generation started. Operation: ' . $data['name'] . '. This is a long-running operation that may take several minutes.';
                } else {
                    $this->generatedVideo = $data['video_url'] ?? $data['generated_video'] ?? $data['output'] ?? null;
                    
                    if (!$this->generatedVideo) {
                        $this->error = 'Video generated but no URL returned';
                    }
                }
            } else {
                $this->error = 'API Error: ' . $response->body();
                Log::error('Google Veo API Error', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
            }
        } catch (\Exception $e) {
            $this->error = 'Connection Error: ' . $e->getMessage();
            Log::error('Google Veo Connection Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        } finally {
            $this->loading = false;
        }
    }

    public function clearResults()
    {
        $this->generatedVideo = null;
        $this->error = null;
        $this->prompt = '';
    }

    public function render()
    {
        return view('livewire.google-veo-generator')
            ->layout('components.layouts.guest');
    }
}
