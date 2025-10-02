<div class="max-w-4xl mx-auto p-6">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Script to Video Generator</h1>
        
        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('message') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Script Input Form -->
        <div class="mb-8">
            <form wire:submit.prevent="submitScript">
                <div class="mb-4">
                    <label for="script" class="block text-sm font-medium text-gray-700 mb-2">
                        Enter your script:
                    </label>
                    <textarea 
                        wire:model="script" 
                        id="script"
                        rows="8" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Paste your script here... The AI will split it into sentences, create shotlists, and generate images and videos for each sentence."
                    ></textarea>
                    @error('script') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <button 
                    type="submit" 
                    style="background-color: black;"
                    class="bg-black text-white px-6 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    wire:loading.attr="disabled"
                >
                    <span wire:loading.remove>Generate Video</span>
                    <span wire:loading>Processing...</span>
                </button>
            </form>
        </div>

        <!-- Processing Status -->
        @if($isProcessing && $currentScript)
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                <div class="flex items-center">
                    <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-blue-600 mr-3"></div>
                    <span class="text-blue-800 font-medium">Processing your script...</span>
                </div>
                <p class="text-blue-600 text-sm mt-2">
                    Status: {{ ucfirst($currentScript->status) }}
                </p>
                <button 
                    wire:click="refreshStatus" 
                    class="mt-2 text-blue-600 hover:text-blue-800 text-sm underline"
                >
                    Refresh Status
                </button>
            </div>
        @endif

        <!-- Results Display -->
        @if($currentScript && $sentences)
            <div class="space-y-6">
                <h2 class="text-2xl font-semibold text-gray-900">Generated Content</h2>
                
                @foreach($sentences as $sentence)
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="mb-3">
                            <h3 class="font-medium text-gray-900">Sentence {{ $sentence->order_index + 1 }}:</h3>
                            <p class="text-gray-700">{{ $sentence->original_sentence }}</p>
                        </div>

                        @if($sentence->shotlist)
                            <div class="mb-3">
                                <h4 class="font-medium text-gray-800 mb-2">Shotlisst:</h4>
                                @php
                                    $shotlistData = json_decode($sentence->shotlist, true);
                                @endphp
                                @if($shotlistData && is_array($shotlistData) && count($shotlistData) > 0)
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Script Part</th>
                                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Second</th>
                                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Original Shot</th>
                                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image Prompt</th>
                                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Video Prompt</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200">
                                                @foreach($shotlistData as $shot)
                                                    <tr class="hover:bg-gray-50">
                                                        <td class="px-4 py-3 text-sm text-gray-700 font-medium">{{ $shot['script'] ?? 'N/A' }}</td>
                                                        <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $shot['second'] ?? 'N/A' }}</td>
                                                        <td class="px-4 py-3 text-sm text-gray-600">{{ $shot['shot'] ?? 'N/A' }}</td>
                                                        <td class="px-4 py-3 text-sm text-gray-600">
                                                            @if(isset($shot['image_prompt']))
                                                                <div class="bg-blue-50 border border-blue-200 rounded p-2">
                                                                    <span class="text-xs text-blue-600 font-medium">Image:</span>
                                                                    <p class="text-xs text-gray-700 mt-1">{{ $shot['image_prompt'] }}</p>
                                                                </div>
                                                            @else
                                                                <span class="text-gray-400">Not enhanced</span>
                                                            @endif
                                                        </td>
                                                        <td class="px-4 py-3 text-sm text-gray-600">
                                                            @if(isset($shot['video_prompt']))
                                                                <div class="bg-green-50 border border-green-200 rounded p-2">
                                                                    <span class="text-xs text-green-600 font-medium">Video:</span>
                                                                    <p class="text-xs text-gray-700 mt-1">{{ $shot['video_prompt'] }}</p>
                                                                </div>
                                                            @else
                                                                <span class="text-gray-400">Not enhanced</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                        <p class="text-sm text-yellow-800">Raw shotlist data:</p>
                                        <pre class="text-xs text-gray-600 mt-2 whitespace-pre-wrap">{{ $sentence->shotlist }}</pre>
                                    </div>
                                @endif
                            </div>
                        @endif

                        @if($sentence->image_prompt)
                            <div class="mb-3">
                                <h4 class="font-medium text-gray-800">Image Prompt:</h4>
                                <p class="text-sm text-gray-600 bg-gray-50 p-2 rounded">{{ $sentence->image_prompt }}</p>
                            </div>
                        @endif

                        @if($sentence->video_prompt)
                            <div class="mb-3">
                                <h4 class="font-medium text-gray-800">Video Prompt:</h4>
                                <p class="text-sm text-gray-600 bg-gray-50 p-2 rounded">{{ $sentence->video_prompt }}</p>
                            </div>
                        @endif

                        <!-- Generated Assets -->
                        @if($sentence->assets->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($sentence->assets as $asset)
                                    <div class="border border-gray-200 rounded p-3">
                                        <h5 class="font-medium text-gray-800 capitalize">{{ $asset->type }}:</h5>
                                        @if($asset->type === 'image')
                                            <img src="{{ $asset->url }}" alt="Generated image" class="w-full h-48 object-cover rounded mt-2">
                                        @elseif($asset->type === 'video')
                                            <video controls class="w-full h-48 rounded mt-2">
                                                <source src="{{ $asset->url }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        @endif
                                        <p class="text-xs text-gray-500 mt-1">Status: {{ ucfirst($asset->status) }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
