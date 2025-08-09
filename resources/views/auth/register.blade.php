@extends('layouts.auth')
@section('title', 'Register')

@section('content')
    <div class="flex flex-col items-center justify-center min-h-screen px-4 py-12">
        <div class="w-full max-w-md">
            <div class="flex justify-center">
                <a href="{{ route('dashboard') }}">
                    <img class="h-12" src="{{ asset('logo.png') }}" alt="logo">
                </a>
            </div>

            <div class="p-8 mt-6 bg-white rounded-lg shadow-md dark:bg-slate-800">
                <h1 class="text-2xl font-bold text-center">Voter Registration</h1>
                <p class="mt-2 text-sm text-center text-gray-600 dark:text-gray-400">Your account will be pending admin approval</p>

                @if(session('success'))
                    <div class="mt-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
                @endif

                <form class="mt-6" method="POST" action="{{ route('register.submit') }}">
                    @csrf

                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-slate-600 dark:text-slate-300">Full Name*</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Enter your full name"
                               class="block w-full px-4 py-3 text-sm border-slate-200 rounded-md dark:bg-slate-700 dark:border-slate-600 @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label for="email" class="block mb-2 text-sm font-medium text-slate-600 dark:text-slate-300">Email*</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter your email"
                               class="block w-full px-4 py-3 text-sm border-slate-200 rounded-md dark:bg-slate-700 dark:border-slate-600 @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label for="user_id" class="block mb-2 text-sm font-medium text-slate-600 dark:text-slate-300">{{ $settings->id_name ?? 'User ID' }}*</label>
                        <input type="number" id="user_id" name="user_id" value="{{ old('user_id') }}" required autocomplete="user_id" placeholder="{{ $settings->id_name ?? 'User ID' }}"
                               class="block w-full px-4 py-3 text-sm border-slate-200 rounded-md dark:bg-slate-700 dark:border-slate-600 @error('user_id') border-red-500 @enderror">
                        @error('user_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label for="category_id" class="block mb-2 text-sm font-medium text-slate-600 dark:text-slate-300">Category*</label>
                        <select id="category_id" name="category_id" required
                                class="block w-full px-4 py-3 text-sm border-slate-200 rounded-md dark:bg-slate-700 dark:border-slate-600 @error('category_id') border-red-500 @enderror">
                            <option value="">Select your category</option>
                            @foreach(\App\Models\Category::all() as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label for="password" class="block mb-2 text-sm font-medium text-slate-600 dark:text-slate-300">Password (Minimum of 6 characters)*</label>
                        <input type="password" id="password" name="password" autocomplete="new-password" placeholder="*********"
                               class="block w-full px-4 py-3 text-sm border-slate-200 rounded-md dark:bg-slate-700 dark:border-slate-600 @error('password') border-red-500 @enderror">
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label for="password_confirm" class="block mb-2 text-sm font-medium text-slate-600 dark:text-slate-300">Confirm Password*</label>
                        <input type="password" id="password_confirm" name="password_confirmation" autocomplete="new-password" placeholder="*********"
                               class="block w-full px-4 py-3 text-sm border-slate-200 rounded-md dark:bg-slate-700 dark:border-slate-600">
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="w-full px-4 py-3 font-bold text-white bg-blue-600 rounded-md hover:bg-blue-700">
                            Register
                        </button>
                    </div>

                    <p class="mt-6 text-sm text-center">
                        Already have an account?
                        <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:underline dark:text-blue-500">
                            Sign In
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection