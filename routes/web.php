<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Volt::route('/', 'home')->name('home');
Volt::route('/hello', 'hello')->name('hello');

Route::get('/test', function () {
    return view('livewire.test');
})->name('test');

Route::get('/google-veo-generator', \App\Livewire\GoogleVeoGenerator::class)->name('google.veo.generator');

Route::get('/script-processor', \App\Livewire\ScriptProcessor::class)->name('script.processor');

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
