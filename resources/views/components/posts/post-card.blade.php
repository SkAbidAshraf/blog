@props(['post'])
<div {{$attributes}}>
    <a wire:navigate href="{{ route('posts.show', $post->slug)}}">
        <div>
            <img class="w-full h-52 object-cover rounded-lg opacity-100 hover:opacity-80 hover:scale-105 transition-all duration-300 " src="{{ $post->getThumbnailImage() }}">
        </div>
    </a>
    <div class="mt-3">
       <a wire:navigate href="{{ route('posts.show', $post->slug)}}" class="xl:text-xl text-base sm:text-sm font-bold text-gray-900 hover:text-blue-600">{{ $post->title }} </a>
    </div>

    <div class="mt-3">
        <div class="topics flex flex-wrap justify-start my-3 gap-y-2 gap-x-1 text-xs">
            @php $count = 0; @endphp
            @foreach ($post->tags as $tag)
                @if ($count < 3)
                    <x-posts.tag-badge :tag="$tag" />
                    @php $count++; @endphp
                @else
                    @break
                @endif
            @endforeach
        </div>
        {{-- <p class="text-gray-500 text-sm">Posted {{ $post->getPublishedDate() }}</p> --}}
        <p class="text-gray-500 text-sm">posted {{ $post->published_at->diffForHumans() }}</p>
    </div>
</div>
