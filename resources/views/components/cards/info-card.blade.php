@props(['icon', 'title', 'value', 'variant' => 'primary'])

<x-card :variant="$variant" {{ $attributes->merge(['class' => 'hover:shadow-lg transition-shadow']) }}>
    <span class="font-medium">{{ $title }}</span>
    <div class="flex items-end gap-1 mt-2">
        <h4 class="mb-0 mt-1">{{ $value }}</h4>
    </div>
    @if($icon)
    <div class="mt-4 opacity-20">
        <i data-feather="{{ $icon }}"></i>
    </div>
    @endif
</x-card>