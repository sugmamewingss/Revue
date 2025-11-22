@extends('layouts.app')

@section('title', 'Home - Revue')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl p-12 text-white mb-8">
        <h1 class="text-4xl font-bold mb-4">Discover & Review</h1>
        <p class="text-xl text-indigo-100">Your favorite books and movies in one place</p>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
        <div class="flex flex-wrap gap-4 items-center">
            <div>
                <label class="text-sm font-medium text-gray-700 mr-2">Type:</label>
                <select onchange="window.location.href='{{ route('home') }}?type=' + this.value" 
                        class="border border-gray-300 rounded-lg px-4 py-2">
                    <option value="">All</option>
                    <option value="book" {{ request('type') == 'book' ? 'selected' : '' }}>Books</option>
                    <option value="movie" {{ request('type') == 'movie' ? 'selected' : '' }}>Movies</option>
                </select>
            </div>
            
            <div>
                <label class="text-sm font-medium text-gray-700 mr-2">Genre:</label>
                <select onchange="window.location.href='{{ route('home') }}?genre=' + this.value + '&type={{ request('type') }}'" 
                        class="border border-gray-300 rounded-lg px-4 py-2">
                    <option value="">All Genres</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}" {{ request('genre') == $genre->id ? 'selected' : '' }}>
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label class="text-sm font-medium text-gray-700 mr-2">Sort:</label>
                <select onchange="window.location.href='{{ route('home') }}?sort=' + this.value + '&type={{ request('type') }}&genre={{ request('genre') }}'" 
                        class="border border-gray-300 rounded-lg px-4 py-2">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                    <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Highest Rated</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Items Grid -->
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
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500 text-lg">No items found</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $items->links() }}
    </div>
</div>
@endsection