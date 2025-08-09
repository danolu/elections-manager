@props([
    'href' => '#',
    'title' => '',
    'icon' => '',
    'color' => 'primary'
])

<a {{ $attributes->merge(['href' => $href, 'class' => 'block group']) }}>
    <x-card :variant="$color" class="transition-all duration-300 group-hover:shadow-lg">
        <div class="flex items-center">
            <div class="flex-1">
                <span class="font-medium">{{ $title }}</span>
            </div>
            @if ($icon)
            <div class="opacity-50">
                <i data-feather="{{ $icon }}"></i>
            </div>
            @endif
        </div>
    </x-card>
</a>