@extends('layouts.app')

@section('title', 'Import Voters')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Import Voters</h1>
        <p class="text-gray-600 mt-2">Upload a CSV or Excel file to import multiple voters at once</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-4 rounded-lg mb-4">
            <p class="font-semibold">{{ session('error') }}</p>
            @if(session('errors'))
                <ul class="mt-2 list-disc list-inside">
                    @foreach(session('errors') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">📥 Upload File</h2>
        
        <form action="{{ route('voters.import.process') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-4">
                <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                    Select CSV or Excel File
                </label>
                <input 
                    type="file" 
                    name="file" 
                    id="file" 
                    accept=".csv,.xlsx,.xls"
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:border-blue-500 p-2"
                    required
                >
                @error('file')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3">
                <button 
                    type="submit" 
                    class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 font-medium"
                >
                    Import Voters
                </button>
                <a 
                    href="{{ route('voters.index') }}" 
                    class="bg-gray-200 text-gray-700 px-6 py-2 rounded-md hover:bg-gray-300 font-medium"
                >
                    Cancel
                </a>
            </div>
        </form>
    </div>

    <div class="bg-blue-50 rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">📋 File Format Instructions</h2>
        
        <div class="space-y-3 text-sm text-gray-700">
            <p><strong>Required columns:</strong></p>
            <ul class="list-disc list-inside ml-4 space-y-1">
                <li><code class="bg-gray-200 px-2 py-1 rounded">name</code> - Full name of the voter</li>
                <li><code class="bg-gray-200 px-2 py-1 rounded">email</code> - Email address (must be unique)</li>
                <li><code class="bg-gray-200 px-2 py-1 rounded">user_id</code> - Unique user ID number</li>
                <li><code class="bg-gray-200 px-2 py-1 rounded">category_id</code> - Category ID (must exist in categories table)</li>
            </ul>

            <p class="mt-4"><strong>Optional columns:</strong></p>
            <ul class="list-disc list-inside ml-4 space-y-1">
                <li><code class="bg-gray-200 px-2 py-1 rounded">password</code> - Password (defaults to "password123" if not provided)</li>
                <li><code class="bg-gray-200 px-2 py-1 rounded">is_admin</code> - "yes" or "no" (defaults to "no")</li>
            </ul>

            <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded">
                <p class="text-yellow-800"><strong>⚠️ Important:</strong></p>
                <ul class="list-disc list-inside ml-4 mt-2 text-yellow-700">
                    <li>The first row must contain column headers (exactly as shown above)</li>
                    <li>Email addresses and user IDs must be unique</li>
                    <li>Category IDs must exist in your categories table (create categories first at <a href="{{ route('categories.index') }}" class="underline">/categories</a>)</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">📄 Download Sample Template</h2>
        <p class="text-gray-600 mb-4">
            Download a sample CSV file with the correct format and example data.
        </p>
        <a 
            href="{{ route('voters.import.template') }}" 
            class="inline-flex items-center bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 font-medium"
        >
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            Download Template
        </a>
    </div>
</div>
@endsection

