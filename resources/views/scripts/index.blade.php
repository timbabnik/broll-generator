<x-layouts.app>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold">My Scripts</h1>
                        <a href="{{ route('script.processor') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                            Create New Script
                        </a>
                    </div>

                    @if($scripts->count() > 0)
                        <div class="grid gap-6">
                            @foreach($scripts as $script)
                                <div class="border border-gray-200 rounded-lg p-6">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900">
                                                Script #{{ $script->id }}
                                            </h3>
                                            <p class="text-sm text-gray-500">
                                                Created: {{ $script->created_at->format('M d, Y H:i') }}
                                            </p>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <span class="px-2 py-1 text-xs font-medium rounded-full
                                                @if($script->status === 'completed') bg-green-100 text-green-800
                                                @elseif($script->status === 'processing') bg-blue-100 text-blue-800
                                                @elseif($script->status === 'failed') bg-red-100 text-red-800
                                                @else bg-gray-100 text-gray-800
                                                @endif">
                                                {{ ucfirst($script->status) }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <p class="text-gray-700 text-sm line-clamp-3">
                                            {{ Str::limit($script->content, 200) }}
                                        </p>
                                    </div>

                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4 text-sm">
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

                                    <div class="flex justify-between items-center">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('scripts.show', $script) }}" 
                                               class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                                View Details
                                            </a>
                                        </div>
                                        <form action="{{ route('scripts.destroy', $script) }}" method="POST" 
                                              onsubmit="return confirm('Are you sure you want to delete this script?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            {{ $scripts->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="text-gray-500 mb-4">
                                <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No scripts yet</h3>
                            <p class="text-gray-500 mb-4">Get started by creating your first script.</p>
                            <a href="{{ route('script.processor') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                                Create Your First Script
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
