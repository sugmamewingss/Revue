@extends('layouts.app')

@section('title', 'Register - Revue')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center px-4 py-8">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Create Account</h1>
            <p class="text-gray-600">Join our community of reviewers</p>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg p-8">
            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            
            <form action="{{ route('register') }}" method="POST">
                @csrf
                
                <!-- Name -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>
                
                <!-- Username -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                    <input type="text" name="username" value="{{ old('username') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>
                
                <!-- Email -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>
                
                <!-- Password -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" name="password" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <p class="text-xs text-gray-500 mt-1">Minimum 8 characters</p>
                </div>
                
                <!-- Confirm Password -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                    <input type="password" name="password_confirmation" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>
                
                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 font-semibold transition-colors">
                    Create Account
                </button>
            </form>
            
            <div class="mt-6 text-center">
                <p class="text-gray-600">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-700 font-semibold">
                        Login here
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection