@extends('layouts.auth')
@section('title', 'Verify Email')

@section('content')
    <div class="flex flex-col items-center justify-center min-h-screen px-4 py-12">
        <div class="w-full max-w-md">
            <div class="p-8 bg-white rounded-lg shadow-md dark:bg-slate-800">
                <h1 class="text-2xl font-bold text-center">Verify Your Email Address</h1>

                <div class="mt-6">
                    @if (session('message'))
                        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                            A verification link has been sent to your email address. Kindly check your email for the link to get verified before proceeding.
                        </div>
                    @endif

                    <form method="get" class="inline" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="w-full px-4 py-3 font-bold text-white bg-blue-600 rounded-md hover:bg-blue-700">
                            Resend Verification Link
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection