@extends('layouts.auth')
@section('title', 'Login')

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen px-4 py-12 bg-gray-100">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <div class="flex justify-center mb-8">
                <a href="{{ route('dashboard') }}">
                    <img class="h-16 w-auto" src="{{ $settings->logo ?? asset('/logo.png') }}" alt="{{ $settings->name ?? '' }} Logo">
                </a>
            </div>

            <form method="POST" action="{{ route('login.submit') }}">
                @csrf
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Sign In</h2>

                <div class="mb-4">
                    <label for="login" class="block text-sm font-medium text-gray-700">User ID or Email</label>
                    <input id="login" name="login" type="text" value="{{ old('login') }}" required autofocus placeholder="Enter User ID or Email"
                           class="block w-full px-4 py-3 mt-1 text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('login') border-red-500 @enderror">
                    @error('login')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" name="password" type="password" required placeholder="Password"
                           class="block w-full px-4 py-3 mt-1 text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label for="remember" class="block ml-2 text-sm text-gray-900">Remember me</label>
                    </div>
                </div>

                <div class="mb-6">
                    <button type="submit" class="w-full px-4 py-3 font-bold text-white bg-blue-600 rounded-md hover:bg-blue-700">
                        SIGN IN
                    </button>
                </div>

                <p class="text-center text-sm text-gray-600">
                    Forgot password?
                    <a class="font-medium text-blue-600 hover:underline" href="{{ route('password.request') }}">Reset</a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection