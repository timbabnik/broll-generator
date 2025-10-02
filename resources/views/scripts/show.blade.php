<x-layouts.app>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Script #{{ $script->id }}</h1>
                    <div class="flex space-x-2">
                        <a href="{{ route('scripts.index') }}" class="text-gray-600 hover:text-gray-800">
                            ← Back to Scripts
                        </a>
                        <a href="{{ route('script.processor') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                            Create New Script
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Script Status -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Script Status</h3>
                        <span class="px-3 py-1 text-sm font-medium rounded-full
                            @if($script->status === 'completed') bg-green-100 text-green-800
                            @elseif($script->status === 'processing') bg-blue-100 text-blue-800
                            @elseif($script->status === 'failed') bg-red-100 text-red-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ ucfirst($script->status) }}
                        </span>
                    </div>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                        <div>
                            <span class="text-gray-500">Sentences:</span>
                            <span class="font-medium">{{ $script->sentences->count() }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Images:</span>
                            <span class="font-medium">{{ $script->sentences->flatMap->images->count() }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Videos:</span>
                            <span class="font-medium">{{ $script->sentences->flatMap->videos->count() }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Progress:</span>
                            <span class="font-medium">
                                {{ $script->sentences->where('status', 'completed')->count() }}/{{ $script->sentences->count() }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Original Script -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Original Script</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-700 whitespace-pre-wrap">{{ $script->content }}</p>
                    </div>
                </div>
            </div>

            <!-- Generated Content -->
            @if($script->sentences->count() > 0)
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-gray-900">Generated Content</h3>
                    
                    @foreach($script->sentences as $sentence)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <h4 class="text-md font-semibold text-gray-900">
                                        Sentence {{ $sentence->order_index + 1 }}
                                    </h4>
                                    <span class="px-2 py-1 text-xs font-medium rounded-full
                                        @if($sentence->status === 'completed') bg-green-100 text-green-800
                                        @elseif($sentence->status === 'processing') bg-blue-100 text-blue-800
                                        @elseif($sentence->status === 'failed') bg-red-100 text-red-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ ucfirst($sentence->status) }}
                                    </span>
                                </div>

                                <div class="mb-4">
                                    <p class="text-gray-700 font-medium">{{ $sentence->original_sentence }}</p>
                                </div>

                                @if($sentence->shotlist)
                                    <div class="mb-4">
                                        <h5 class="font-medium text-gray-800 mb-2">Shotlist:</h5>
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
                                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Generated Image</th>
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
                                                                <td class="px-4 py-3 text-sm text-gray-600">
                                                                    @php
                                                                        $shotIndex = $loop->index;
                                                                        $generatedImage = $sentence->assets->where('type', 'image')
                                                                            ->filter(function($asset) use ($shotIndex) {
                                                                                $metadata = is_string($asset->metadata) ? json_decode($asset->metadata, true) : $asset->metadata;
                                                                                return isset($metadata['shot_index']) && $metadata['shot_index'] == $shotIndex;
                                                                            })
                                                                            ->first();
                                                                    @endphp
                                                                    @if($generatedImage && $generatedImage->url)
                                                                        <img src="{{ $generatedImage->url }}" 
                                                                             alt="Generated image for shot {{ $shotIndex + 1 }}" 
                                                                             class="w-24 h-24 object-cover rounded border">
                                                                    @else
                                                                        <div class="w-24 h-24 bg-gray-100 border border-gray-200 rounded flex items-center justify-center">
                                                                            <span class="text-xs text-gray-400">Generating...</span>
                                                                        </div>
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
                                    <div class="mb-4">
                                        <h5 class="font-medium text-gray-800 mb-2">Image Prompt:</h5>
                                        <div class="bg-gray-50 p-3 rounded text-sm text-gray-600">
                                            {{ $sentence->image_prompt }}
                                        </div>
                                    </div>
                                @endif

                                @if($sentence->video_prompt)
                                    <div class="mb-4">
                                        <h5 class="font-medium text-gray-800 mb-2">Video Prompt:</h5>
                                        <div class="bg-gray-50 p-3 rounded text-sm text-gray-600">
                                            {{ $sentence->video_prompt }}
                                        </div>
                                    </div>
                                @endif

                                <!-- Generated Assets -->
                                @if($sentence->assets->count() > 0)
                                    <div class="mt-4">
                                        <h5 class="font-medium text-gray-800 mb-3">Generated Media:</h5>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            @foreach($sentence->assets as $asset)
                                                <div class="border border-gray-200 rounded-lg p-4">
                                                    <div class="flex justify-between items-center mb-2">
                                                        <h6 class="font-medium text-gray-800 capitalize">{{ $asset->type }}</h6>
                                                        <span class="px-2 py-1 text-xs font-medium rounded-full
                                                            @if($asset->status === 'completed') bg-green-100 text-green-800
                                                            @elseif($asset->status === 'processing') bg-blue-100 text-blue-800
                                                            @elseif($asset->status === 'failed') bg-red-100 text-red-800
                                                            @else bg-gray-100 text-gray-800
                                                            @endif">
                                                            {{ ucfirst($asset->status) }}
                                                        </span>
                                                    </div>
                                                    
                                                    @if($asset->type === 'image' && $asset->url)
                                                        <img src="{{ $asset->url }}" alt="Generated image" 
                                                             class="w-full h-48 object-cover rounded">
                                                    @elseif($asset->type === 'video' && $asset->url)
                                                        <video controls class="w-full h-48 rounded">
                                                            <source src="{{ $asset->url }}" type="video/mp4">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                    @endif
                                                    
                                                    @if($asset->metadata)
                                                        <div class="mt-2 text-xs text-gray-500">
                                                            <details>
                                                                <summary class="cursor-pointer">Metadata</summary>
                                                                <pre class="mt-1 text-xs">{{ json_encode($asset->metadata, JSON_PRETTY_PRINT) }}</pre>
                                                            </details>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Image Prompts Summary -->
            @if($script->sentences->where('image_prompt', '!=', null)->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-8">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-6">Generated Image Prompts</h3>
                        
                        <div class="space-y-6">
                            @foreach($script->sentences->where('image_prompt', '!=', null) as $sentence)
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-start justify-between mb-3">
                                        <h4 class="text-md font-semibold text-gray-800">
                                            Sentence {{ $sentence->order_index + 1 }}
                                        </h4>
                                        <span class="text-xs text-gray-500">
                                            {{ $sentence->created_at->format('M d, Y H:i') }}
                                        </span>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <p class="text-sm text-gray-600 italic">"{{ $sentence->original_sentence }}"</p>
                                    </div>

                                    @php
                                        $shotlistData = json_decode($sentence->shotlist, true);
                                    @endphp

                                    @if($shotlistData && is_array($shotlistData))
                                        <div class="grid gap-4">
                                            @foreach($shotlistData as $index => $shot)
                                                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-lg p-4">
                                                    <div class="flex items-center justify-between mb-2">
                                                        <div class="flex items-center space-x-3">
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                                Second {{ $shot['second'] ?? $index }}
                                                            </span>
                                                            <span class="text-sm font-medium text-gray-700">
                                                                {{ $shot['script'] ?? 'Script text' }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="text-sm text-gray-600 leading-relaxed">
                                                        {{ $shot['shot'] ?? 'Visual description' }}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                    @if($sentence->image_prompt)
                                        <div class="mt-4 p-4 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-lg">
                                            <div class="flex items-center mb-2">
                                                <svg class="w-4 h-4 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                <span class="text-sm font-medium text-green-800">Enhanced Image Prompt</span>
                                            </div>
                                            <p class="text-sm text-gray-700 leading-relaxed">{{ $sentence->image_prompt }}</p>
                                        </div>
                                    @endif

                                    @if($sentence->video_prompt)
                                        <div class="mt-3 p-4 bg-gradient-to-r from-purple-50 to-pink-50 border border-purple-200 rounded-lg">
                                            <div class="flex items-center mb-2">
                                                <svg class="w-4 h-4 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                                </svg>
                                                <span class="text-sm font-medium text-purple-800">Video Generation Prompt</span>
                                            </div>
                                            <p class="text-sm text-gray-700 leading-relaxed">{{ $sentence->video_prompt }}</p>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
