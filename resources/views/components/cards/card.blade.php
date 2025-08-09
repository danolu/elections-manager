@props([
    'header' => null,
    'footer' => null,
    'variant' => 'default',
])

@php
    $variants = [
        'default' => 'bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100',
        'primary' => 'bg-primary-500 text-white',
        'secondary' => 'bg-secondary-500 text-white',
        'info' => 'bg-blue-400 text-white',
    ];
@endphp

<div {{ $attributes->merge(['class' => 'shadow-sm sm:rounded-lg overflow-hidden ' . ($variants[$variant] ?? $variants['default'])]) }}>
    @if ($header)
        <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            {{ $header }}
        </div>
    @endif

    <div class="p-6">
        {{ $slot }}
    </div>

    @if ($footer)
        <div class="p-4 border-t border-gray-200 dark:border-gray-700">
            {{ $footer }}
        </div>
    @endif
</div>