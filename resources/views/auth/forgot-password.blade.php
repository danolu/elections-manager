@extends('layouts.auth')
@section('title', 'Forgot Password')

@section('content')
    <div class="flex flex-col items-center justify-center min-h-screen px-4">
        <div class="w-full max-w-sm">
            <div class="flex justify-center">
                <a href="{{ route('dashboard') }}">
                    <img class="h-12" src="{{ asset('logo.png') }}" alt="logo">
                </a>
            </div>

            <div class="p-8 mt-6 bg-white rounded-lg shadow-md dark:bg-slate-800">
                @if (session('status'))
                    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <h1 class="text-2xl font-bold text-center">Reset Your Password</h1>

                    <div class="mt-6">
                        <label for="email" class="block mb-2 text-sm font-medium text-slate-600 dark:text-slate-300">
                            Enter Your Email
                        </label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            class="block w-full px-4 py-3 text-sm border-slate-200 rounded-md dark:bg-slate-700 dark:border-slate-600 @error('email') border-red-500 @enderror"
                        >
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="w-full px-4 py-3 font-bold text-white bg-blue-600 rounded-md hover:bg-blue-700">
                            SEND RESET LINK
                        </button>
                    </div>

                    <p class="mt-6 text-sm text-center">
                        Hippocampus triggered?
                        <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:underline dark:text-blue-500">
                            Sign in.
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection