@extends('layouts.auth')
@section('title', 'Reset Password')

@section('content')
    <div class="flex flex-col items-center justify-center min-h-screen px-4 py-12">
        <div class="w-full max-w-md">
            <div class="flex justify-center">
                <a href="{{ route('dashboard') }}">
                    <img class="h-12" src="{{ asset('logo.png') }}" alt="logo">
                </a>
            </div>

            <div class="p-8 mt-6 bg-white rounded-lg shadow-md dark:bg-slate-800">
                <h1 class="text-2xl font-bold text-center">Create New Password</h1>

                <form class="mt-6" method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-slate-600 dark:text-slate-300">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                               class="block w-full px-4 py-3 text-sm border-slate-200 rounded-md dark:bg-slate-700 dark:border-slate-600 @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label for="password" class="block mb-2 text-sm font-medium text-slate-600 dark:text-slate-300">New Password</label>
                        <input type="password" id="password" name="password" required autocomplete="new-password" placeholder="*********"
                               class="block w-full px-4 py-3 text-sm border-slate-200 rounded-md dark:bg-slate-700 dark:border-slate-600 @error('password') border-red-500 @enderror">
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label for="password_confirmation" class="block mb-2 text-sm font-medium text-slate-600 dark:text-slate-300">Retype Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" placeholder="*********"
                               class="block w-full px-4 py-3 text-sm border-slate-200 rounded-md dark:bg-slate-700 dark:border-slate-600">
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="w-full px-4 py-3 font-bold text-white bg-blue-600 rounded-md hover:bg-blue-700">
                            RESET PASSWORD
                        </button>
                    </div>

                    <p class="mt-6 text-sm text-center">
                        <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:underline dark:text-blue-500">
                            Sign in here
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection