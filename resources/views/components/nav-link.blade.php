@props(['active', 'navigate'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center font-semibold hover:text-blue-900 text-base text-blue-600'
            : 'inline-flex items-center font-semibold hover:text-blue-900 text-base text-gray-500';
@endphp

<a {{ $navigate ?? true ? 'wire:navigate' : '' }}  {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
