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
                                        <div class="bg-gray-50 p-3 rounded text-sm text-gray-600">
                                            {{ $sentence->shotlist }}
                                        </div>
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
        </div>
    </div>
</x-layouts.app>
