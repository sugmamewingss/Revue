@extends('layouts.app')

@section('title', $item->title . ' - Revue')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Item Details -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-8">
        <div class="md:flex">
            <!-- Cover Image -->
            <div class="md:w-1/3 bg-gray-200">
                @if($item->cover_image)
                    <img src="{{ asset('storage/' . $item->cover_image) }}" 
                         alt="{{ $item->title }}" 
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-96 flex items-center justify-center text-gray-400">
                        <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                @endif
            </div>
            
            <!-- Item Info -->
            <div class="md:w-2/3 p-8">
                <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full mb-3
                             {{ $item->type == 'book' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                    {{ ucfirst($item->type) }}
                </span>
                
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $item->title }}</h1>
                
                @if($item->author_or_director)
                    <p class="text-xl text-gray-600 mb-4">
                        {{ $item->type == 'book' ? 'by' : 'directed by' }} {{ $item->author_or_director }}
                    </p>
                @endif
                
                @if($item->release_year)
                    <p class="text-gray-500 mb-4">{{ $item->release_year }}</p>
                @endif
                
                <!-- Genres -->
                <div class="flex flex-wrap gap-2 mb-6">
                    @foreach($item->genres as $genre)
                        <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm">
                            {{ $genre->name }}
                        </span>
                    @endforeach
                </div>
                
                <!-- Rating Summary -->
                <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-lg p-6 mb-6">
                    <div class="flex items-center">
                        <div class="text-center mr-8">
                            <div class="text-5xl font-bold text-indigo-600">
                                {{ $averageRating ? number_format($averageRating, 1) : 'N/A' }}
                            </div>
                            <div class="text-yellow-400 text-2xl">★★★★★</div>
                            <div class="text-sm text-gray-600 mt-1">{{ $totalReviews }} reviews</div>
                        </div>
                        
                        <!-- Rating Distribution -->
                        <div class="flex-1">
                            @foreach($ratingDistribution as $rating => $data)
                                <div class="flex items-center mb-1">
                                    <span class="text-sm text-gray-600 w-8">{{ $rating }}</span>
                                    <div class="flex-1 mx-2 bg-gray-200 rounded-full h-2">
                                        <div class="bg-indigo-600 h-2 rounded-full" 
                                             style="width: {{ $data['percentage'] }}%"></div>
                                    </div>
                                    <span class="text-sm text-gray-600 w-12">{{ $data['count'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <!-- Description -->
                @if($item->description)
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-3">Description</h2>
                        <p class="text-gray-700 leading-relaxed">{{ $item->description }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Review Form (Authenticated Users Only) -->
    @auth
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">
                {{ $userReview ? 'Edit Your Review' : 'Write a Review' }}
            </h2>
            
            <form action="{{ $userReview ? route('reviews.update', $userReview->id) : route('reviews.store') }}" 
                  method="POST" id="reviewForm">
                @csrf
                @if($userReview)
                    @method('PUT')
                @else
                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                @endif
                
                <!-- Rating -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Your Rating (1-10)
                    </label>
                    <div class="star-rating" id="starRating">
                        @for($i = 1; $i <= 10; $i++)
                            <button type="button" class="star text-3xl {{ $userReview && $userReview->rating >= $i ? 'active' : '' }}" 
                                    data-rating="{{ $i }}">★</button>
                        @endfor
                    </div>
                    <input type="hidden" name="rating" id="ratingInput" value="{{ $userReview->rating ?? '' }}" required>
                    @error('rating')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Review Text -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Your Review (Optional)
                    </label>
                    <textarea name="review_text" rows="5" 
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                              placeholder="Share your thoughts...">{{ $userReview->review_text ?? '' }}</textarea>
                    @error('review_text')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex gap-3">
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
                        {{ $userReview ? 'Update Review' : 'Submit Review' }}
                    </button>
                    
                    @if($userReview)
                        <button type="button" onclick="if(confirm('Are you sure?')) document.getElementById('deleteForm').submit()" 
                                class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700">
                            Delete Review
                        </button>
                    @endif
                </div>
            </form>
            
            @if($userReview)
                <form id="deleteForm" action="{{ route('reviews.destroy', $userReview->id) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
            @endif
        </div>
    @else
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8 text-center">
            <p class="text-gray-600 mb-4">Please login to write a review</p>
            <a href="{{ route('login') }}" class="inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
                Login
            </a>
        </div>
    @endauth
    
    <!-- All Reviews -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Reviews ({{ $totalReviews }})</h2>
        
        <div class="space-y-6">
            @forelse($item->reviews()->with('user')->latest()->get() as $review)
                <div class="border-b border-gray-200 pb-6 last:border-0">
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            <h4 class="font-semibold text-gray-900">{{ $review->user->name }}</h4>
                            <p class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="flex items-center">
                            <span class="text-yellow-400 mr-1">★</span>
                            <span class="font-semibold text-gray-900">{{ $review->rating }}/10</span>
                        </div>
                    </div>
                    @if($review->review_text)
                        <p class="text-gray-700">{{ $review->review_text }}</p>
                    @endif
                </div>
            @empty
                <p class="text-gray-500 text-center py-8">No reviews yet. Be the first to review!</p>
            @endforelse
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Star Rating
    const stars = document.querySelectorAll('.star');
    const ratingInput = document.getElementById('ratingInput');
    
    stars.forEach(star => {
        star.addEventListener('click', function() {
            const rating = this.dataset.rating;
            ratingInput.value = rating;
            
            stars.forEach(s => {
                if (parseInt(s.dataset.rating) <= rating) {
                    s.classList.add('active');
                } else {
                    s.classList.remove('active');
                }
            });
        });
    });
</script>
@endpush
@endsection