@extends('layouts.app')

@section('title', 'Search Results - Revue')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Search Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">
            Search Results for "{{ $keyword }}"
        </h1>
        <p class="text-gray-600">Found {{ $items->total() }} results</p>
    </div>
    
    <!-- Results Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($items as $item)
            <a href="{{ route('items.show', $item->id) }}" class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow overflow-hidden group">
                <div class="aspect-[2/3] bg-gray-200 overflow-hidden">
                    @if($item->cover_image)
                        <img src="{{ asset('storage/' . $item->cover_image) }}" 
                             alt="{{ $item->title }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="p-4">
                    <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full mb-2
                                 {{ $item->type == 'book' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                        {{ ucfirst($item->type) }}
                    </span>
                    <h3 class="font-semibold text-gray-900 mb-1 line-clamp-2">{{ $item->title }}</h3>
                    <p class="text-sm text-gray-600 mb-2">{{ $item->author_or_director }}</p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <span class="font-semibold text-gray-900">
                                {{ number_format($item->averageRating(), 1) ?? 'N/A' }}
                            </span>
                        </div>
                        <span class="text-sm text-gray-500">{{ $item->totalReviews() }} reviews</span>
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-full">
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">No results found</h3>
                    <p class="mt-1 text-gray-500">Try searching with different keywords</p>
                    <div class="mt-6">
                        <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                            Browse All Items
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
    
    <!-- Pagination -->
    @if($items->hasPages())
        <div class="mt-8">
            {{ $items->appends(['q' => $keyword])->links() }}
        </div>
    @endif
</div>
@endsection