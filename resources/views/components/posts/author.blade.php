@props(['author', 'size'])

@php

    $imageSize = match ($size ?? null) {
        'xs' => 'w-7 h-7',
        'sm' => 'w-9 h-9',
        'md' => 'w-10 h-10',
        'lg' => 'w-13 h-13',
        default => 'w-10 h-10',
    };

    $textSize = match ($size ?? null) {
        'xs' => 'text-xs',
        'sm' => 'text-sm',
        'md' => 'text-base',
        'lg' => 'text-lg',
        default => 'text-base',
    };

@endphp
<a class="flex items-center" wire:navigate href="{{ route('posts.index', ['author' => $author->id]) }}">
    <img class="{{ $imageSize }} border border-gray-200 rounded-full mr-2" src="{{ $author->profile_photo_url }}"
        alt="avatar">
    <span class="mr-1 {{ $textSize }}">{{ $author->name }}</span>
</a>
