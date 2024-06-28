@props(['post'])
<a class="font-semibold gap-x-2" wire:navigate href="{{ route('posts.show', $post->slug) }}">
    <div class="bg-white lg:max-w-96 grid grid-cols-3 mb-4 gap-x-2 border-l-4 border-blue-500 text-gray-700" role="alert">
        <div class="col-span-1 h-full w-full">
            <img class="h-16 w-full object-cover hover:opacity-80 transition-all duration-300 " src="{{ $post->getThumbnailImage() }}" alt="thumbnail">

        </div>
        <div class="col-span-2 flex flex-col justify-center hover:text-blue-500 py-2 pr-2 self-start">
            {{ $post->title }}
        </div>
    </div>
</a>
