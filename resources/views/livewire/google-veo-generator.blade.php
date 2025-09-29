<div class="max-w-2xl mx-auto p-6">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
            Google Veo 3 Video Generator
        </h2>

        <form wire:submit.prevent="generateVideo" class="space-y-4">
            <div>
                <label for="apiKey" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Google API Key
                </label>
                <input 
                    type="password" 
                    wire:model="apiKey" 
                    id="apiKey"
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                    placeholder="Enter your Google API key"
                >
                @error('apiKey') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="prompt" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Video Prompt
                </label>
                <textarea 
                    wire:model="prompt" 
                    id="prompt"
                    rows="4"
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                    placeholder="Describe the video you want to generate... (e.g., 'A cat playing piano in a jazz club')"
                ></textarea>
                @error('prompt') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex space-x-4">
                <button 
                    type="submit" 
                    wire:loading.attr="disabled"
                    class="flex-1 bg-blue-600 hover:bg-blue-700 disabled:bg-gray-400 text-white font-medium py-2 px-4 rounded-md transition-colors"
                >
                    <span wire:loading.remove>Generate Video</span>
                    <span wire:loading>
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Generating...
                    </span>
                </button>

                @if($generatedVideo || $error)
                    <button 
                        type="button" 
                        wire:click="clearResults"
                        class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-md transition-colors"
                    >
                        Clear
                    </button>
                @endif
            </div>
        </form>

        @if($error)
            <div class="mt-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-md">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800 dark:text-red-200">
                            Error
                        </h3>
                        <div class="mt-2 text-sm text-red-700 dark:text-red-300">
                            {{ $error }}
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if($generatedVideo)
            <div class="mt-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Generated Video</h3>
                <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4">
                    <video 
                        controls 
                        class="w-full max-w-lg mx-auto rounded-lg"
                        poster="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 300'%3E%3Crect width='400' height='300' fill='%23f3f4f6'/%3E%3Ctext x='50%25' y='50%25' text-anchor='middle' dy='.3em' fill='%236b7280'%3EVideo Preview%3C/text%3E%3C/svg%3E"
                    >
                        <source src="{{ $generatedVideo }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <div class="mt-2 text-center">
                        <a 
                            href="{{ $generatedVideo }}" 
                            target="_blank" 
                            class="text-blue-600 dark:text-blue-400 hover:underline text-sm"
                        >
                            Open in new tab
                        </a>
                    </div>
                </div>
            </div>
        @endif

        @if($loading)
            <div class="mt-6 text-center">
                <div class="inline-flex items-center px-4 py-2 bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 rounded-md">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Generating video... This may take a few minutes.
                </div>
            </div>
        @endif
    </div>
</div>
