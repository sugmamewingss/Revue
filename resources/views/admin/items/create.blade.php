@extends('layouts.app')

@section('title', 'Add New Item - Admin')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Add New Item</h1>
        <p class="text-gray-600">Create a new book or movie entry</p>
    </div>
    
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <div class="bg-white rounded-lg shadow-sm p-8">
        <form action="{{ route('admin.items.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>
                
                <!-- Type -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Type *</label>
                    <select name="type" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="">Select Type</option>
                        <option value="book" {{ old('type') == 'book' ? 'selected' : '' }}>Book</option>
                        <option value="movie" {{ old('type') == 'movie' ? 'selected' : '' }}>Movie</option>
                    </select>
                </div>
                
                <!-- Author/Director -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Author/Director</label>
                    <input type="text" name="author_or_director" value="{{ old('author_or_director') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>
                
                <!-- Release Year -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Release Year</label>
                    <input type="number" name="release_year" value="{{ old('release_year') }}" 
                           min="1800" max="{{ date('Y') + 5 }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>
                
                <!-- Cover Image -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cover Image</label>
                    <input type="file" name="cover_image" accept="image/*"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <p class="text-xs text-gray-500 mt-1">Max 2MB, JPG, PNG, or WEBP</p>
                </div>
                
                <!-- Genres -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Genres</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        @foreach($genres as $genre)
                            <label class="flex items-center">
                                <input type="checkbox" name="genres[]" value="{{ $genre->id }}"
                                       {{ in_array($genre->id, old('genres', [])) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                <span class="ml-2 text-sm text-gray-700">{{ $genre->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                
                <!-- Description -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" rows="5"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">{{ old('description') }}</textarea>
                </div>
            </div>
            
            <div class="flex gap-3 mt-8">
                <button type="submit" 
                        class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
                    Create Item
                </button>
                <a href="{{ route('admin.items') }}" 
                   class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection