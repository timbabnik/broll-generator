<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;


Volt::route('/hello', 'hello')->name('hello');

Route::get('/', function () {
    return view('livewire.test');
})->name('test');

Route::get('/debug-assets', function () {
    $assets = \App\Models\Asset::with('sentence')->get();
    return response()->json([
        'total_assets' => $assets->count(),
        'image_assets' => $assets->where('type', 'image')->count(),
        'video_assets' => $assets->where('type', 'video')->count(),
        'assets' => $assets->map(function($asset) {
            return [
                'id' => $asset->id,
                'type' => $asset->type,
                'url' => $asset->url,
                'status' => $asset->status,
                'sentence_id' => $asset->sentence_id,
                'metadata' => json_decode($asset->metadata, true)
            ];
        })
    ]);
});

Route::get('/debug-script/{script}', function(\App\Models\Script $script) {
    $sentences = $script->sentences()->with('assets')->get();
    return response()->json([
        'script_id' => $script->id,
        'script_status' => $script->status,
        'sentences_count' => $sentences->count(),
        'sentences' => $sentences->map(function($sentence) {
            return [
                'id' => $sentence->id,
                'content' => $sentence->original_sentence,
                'status' => $sentence->status,
                'shotlist' => $sentence->shotlist,
                'image_prompt' => $sentence->image_prompt,
                'video_prompt' => $sentence->video_prompt,
                'assets_count' => $sentence->assets->count(),
                'image_assets' => $sentence->assets->where('type', 'image')->count(),
                'assets' => $sentence->assets->map(function($asset) {
                    return [
                        'id' => $asset->id,
                        'type' => $asset->type,
                        'url' => $asset->url,
                        'status' => $asset->status,
                        'metadata' => is_string($asset->metadata) ? json_decode($asset->metadata, true) : $asset->metadata
                    ];
                })
            ];
        })
    ]);
});

Route::get('/google-veo-generator', \App\Livewire\GoogleVeoGenerator::class)->name('google.veo.generator');

Route::get('/script-processor', \App\Livewire\ScriptProcessor::class)->name('script.processor');
Route::post('/script-processor', function(\Illuminate\Http\Request $request) {
    // Only split into sentences, don't dispatch other jobs
    $script = \App\Models\Script::create([
        'user_id' => null,
        'content' => $request->input('script'),
        'status' => 'pending'
    ]);
    
    // Only dispatch ProcessScriptJob (which only splits sentences)
    \App\Jobs\ProcessScriptJob::dispatch($script);
    
    \Log::info('Script created and ProcessScriptJob dispatched', [
        'script_id' => $script->id,
        'content_length' => strlen($request->input('script'))
    ]);
    
    return response()->json([
        'success' => true,
        'script_id' => $script->id,
        'status' => 'processing'
    ]);
})->name('script.processor.submit');

Route::post('/script-processor/generate-shotlists/{script}', function(\App\Models\Script $script) {
    // Dispatch shotlist generation for all sentences
    $sentences = $script->sentences;
    foreach ($sentences as $sentence) {
        \App\Jobs\GenerateShotlistJob::dispatch($sentence);
    }
    
    return response()->json([
        'success' => true,
        'message' => 'Shotlist generation started'
    ]);
})->name('script.processor.shotlists');

Route::post('/script-processor/enhance-image-prompts/{script}', function(\App\Models\Script $script) {
    // Enhance image prompts for all sentences synchronously
    $sentences = $script->sentences;
    $openAIService = app(\App\Services\OpenAIService::class);
    
    foreach ($sentences as $sentence) {
        if ($sentence->shotlist) {
            $shotlistData = json_decode($sentence->shotlist, true);
            $enhancedShots = [];
            
            foreach ($shotlistData as $shot) {
                try {
                    $enhancedImagePrompt = $openAIService->enhanceToImagePrompt($shot['shot']);
                    
                    $enhancedShots[] = [
                        'second' => $shot['second'],
                        'script' => $shot['script'],
                        'shot' => $shot['shot'],
                        'image_prompt' => $enhancedImagePrompt,
                        'video_prompt' => $shot['video_prompt'] ?? $shot['shot']
                    ];
                } catch (\Exception $e) {
                    \Log::error('Failed to enhance shot', [
                        'sentence_id' => $sentence->id,
                        'shot' => $shot['shot'],
                        'error' => $e->getMessage()
                    ]);
                    // Keep original shot if enhancement fails
                    $enhancedShots[] = $shot;
                }
            }
            
            $sentence->update(['shotlist' => json_encode($enhancedShots)]);
        }
    }
    
    return response()->json([
        'success' => true,
        'message' => 'Image prompts enhanced'
    ]);
})->name('script.processor.enhance.image');

Route::post('/script-processor/enhance-video-prompts/{script}', function(\App\Models\Script $script) {
    // Enhance video prompts for all sentences synchronously
    $sentences = $script->sentences;
    $openAIService = app(\App\Services\OpenAIService::class);
    
    foreach ($sentences as $sentence) {
        if ($sentence->shotlist) {
            $shotlistData = json_decode($sentence->shotlist, true);
            $enhancedShots = [];
            
            foreach ($shotlistData as $shot) {
                try {
                    $enhancedVideoPrompt = $openAIService->enhanceToVideoPrompt(
                        $shot['shot'], 
                        $shot['image_prompt'] ?? $shot['shot']
                    );
                    
                    $enhancedShots[] = [
                        'second' => $shot['second'],
                        'script' => $shot['script'],
                        'shot' => $shot['shot'],
                        'image_prompt' => $shot['image_prompt'] ?? $shot['shot'],
                        'video_prompt' => $enhancedVideoPrompt
                    ];
                } catch (\Exception $e) {
                    \Log::error('Failed to enhance video prompt', [
                        'sentence_id' => $sentence->id,
                        'shot' => $shot['shot'],
                        'error' => $e->getMessage()
                    ]);
                    // Keep original shot if enhancement fails
                    $enhancedShots[] = $shot;
                }
            }
            
            $sentence->update(['shotlist' => json_encode($enhancedShots)]);
        }
    }
    
    return response()->json([
        'success' => true,
        'message' => 'Video prompts enhanced'
    ]);
})->name('script.processor.enhance.video');

Route::post('/script-processor/generate-images/{script}', function(\App\Models\Script $script) {
    // Generate images for all sentences
    $sentences = $script->sentences;
    foreach ($sentences as $sentence) {
        if ($sentence->shotlist) {
            $shotlistData = json_decode($sentence->shotlist, true);
            foreach ($shotlistData as $index => $shot) {
                \App\Jobs\GenerateShotImageJob::dispatch($sentence, $shot, $index);
            }
        }
    }
    
    return response()->json([
        'success' => true,
        'message' => 'Image generation started'
    ]);
})->name('script.processor.generate.images');

Route::get('/script-processor/status/{script}', function(\App\Models\Script $script) {
    $sentences = $script->sentences()->with('assets')->get();
    
    // Check if all sentences have completed shotlists
    $allSentencesCompleted = $sentences->every(function($sentence) {
        return $sentence->status === 'completed' && $sentence->shotlist;
    });
    
    // Count total expected images (based on shotlist entries)
    $totalExpectedImages = 0;
    foreach ($sentences as $sentence) {
        if ($sentence->shotlist) {
            $shotlistData = json_decode($sentence->shotlist, true);
            if (is_array($shotlistData)) {
                $totalExpectedImages += count($shotlistData);
            }
        }
    }
    
    // Count actual generated images
    $totalGeneratedImages = $sentences->sum(function($sentence) {
        return $sentence->assets->where('type', 'image')->count();
    });
    
    // Check if everything is complete
    $allCompleted = $allSentencesCompleted && ($totalGeneratedImages >= $totalExpectedImages);
    
    
    if ($allCompleted) {
        return response()->json([
            'success' => true,
            'completed' => true,
            'script' => $script,
            'sentences' => $sentences->map(function($sentence) {
                $shotlistData = json_decode($sentence->shotlist, true);
                return [
                    'id' => $sentence->id,
                    'content' => $sentence->original_sentence,
                    'shotlist' => $shotlistData,
                    'assets' => $sentence->assets->map(function($asset) {
                        return [
                            'id' => $asset->id,
                            'type' => $asset->type,
                            'url' => $asset->url,
                            'status' => $asset->status,
                            'metadata' => is_string($asset->metadata) ? json_decode($asset->metadata, true) : $asset->metadata
                        ];
                    })
                ];
            })
        ]);
    } else {
        // Count completed sentences for progress
        $completedSentences = $sentences->where('status', 'completed')->count();
        $totalSentences = $sentences->count();
        
        return response()->json([
            'success' => true,
            'completed' => false,
            'progress' => [
                'completed' => $completedSentences,
                'total' => $totalSentences,
                'images_generated' => $totalGeneratedImages,
                'images_expected' => $totalExpectedImages,
                'percentage' => $totalSentences > 0 ? round(($completedSentences / $totalSentences) * 100) : 0
            ],
            'message' => "Processing... {$completedSentences}/{$totalSentences} sentences, {$totalGeneratedImages}/{$totalExpectedImages} images",
            'sentences' => $sentences->map(function($sentence) {
                $shotlistData = json_decode($sentence->shotlist, true);
                return [
                    'id' => $sentence->id,
                    'content' => $sentence->original_sentence,
                    'shotlist' => $shotlistData,
                    'assets' => $sentence->assets->map(function($asset) {
                        return [
                            'id' => $asset->id,
                            'type' => $asset->type,
                            'url' => $asset->url,
                            'status' => $asset->status,
                            'metadata' => is_string($asset->metadata) ? json_decode($asset->metadata, true) : $asset->metadata
                        ];
                    })
                ];
            })
        ]);
    }
})->name('script.processor.status');

// Script management routes (no auth required for testing)
Route::resource('scripts', \App\Http\Controllers\ScriptController::class);
Route::get('scripts/{script}/status', [\App\Http\Controllers\ScriptController::class, 'status'])->name('scripts.status');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

require __DIR__.'/auth.php';
