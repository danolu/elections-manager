<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ $settings->favicon ?? asset('logo.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ $settings->favicon ?? asset('logo.png') }}" type="image/x-icon">
    <title>{{ $settings->name ?? '' }} Election Portal - @yield('title')</title>
    <meta name="description" content="{{ $settings->name ?? '' }} Election Portal" />
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @if($settings)
    <style>
        :root {
            --primary-color: {{ $settings->primary_color ?? '#3B82F6' }};
            --secondary-color: {{ $settings->secondary_color ?? '#10B981' }};
            --accent-color: {{ $settings->accent_color ?? '#F59E0B' }};
        }
        .bg-primary { background-color: var(--primary-color) !important; }
        .text-primary { color: var(--primary-color) !important; }
        .border-primary { border-color: var(--primary-color) !important; }
        .bg-secondary { background-color: var(--secondary-color) !important; }
        .text-secondary { color: var(--secondary-color) !important; }
        .bg-accent { background-color: var(--accent-color) !important; }
        .text-accent { color: var(--accent-color) !important; }
        {!! $settings->custom_css ?? '' !!}
    </style>
    @endif
</head>
<body class="text-slate-900 dark:text-slate-100">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-slate-100 dark:bg-slate-900 font-roboto">
        @include('components.layouts.mobile-header')
        @include('components.layouts.sidebar')

        <div class="flex-1 flex flex-col overflow-hidden">
            @include('components.layouts.header')

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-100 dark:bg-slate-900">
                <div class="container mx-auto px-6 py-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>
</html>
