@props(['post'])
<div class=" border-b border-gray-200">
    <article class="[&:not(:last-child)]:border-b border-white pb-10">
        <div class="article-body grid grid-cols-12 gap-3 mt-5 items-start">
            <div class=" h-full w-full md:col-span-4 sm:col-span-6 col-span-12">
                <a wire:navigate href="{{ route('posts.show', $post->slug) }}">
                    <img class="max-h-80 h-full w-full object-cover mx-auto rounded-lg"
                        src="{{ $post->getThumbnailImage() }}" alt="thumbnail">
                </a>
            </div>
            <div class="col-span-12 md:col-span-8 sm:col-span-6">
                <div class="article-meta flex py-1 justify-between text-sm items-center">
                    <div class="flex items-center">
                        <x-posts.author :author="$post->author" size="sm" />
                        <span class="text-gray-500 text-sm mr-1">|</span>
                        <span class="text-gray-500 text-sm">
                            {{ $post->getReadingTime() <= 1 ? ' 1 minute' : $post->getReadingTime() }} read</span>
                    </div>

                    @auth
                        <livewire:bookmark-button :key="'bookmarkbutton-' . $post->id . now()" :$post />
                    @endauth

                </div>
                <h2 class="text-xl font-bold text-gray-900">
                    <a wire:navigate href="{{ route('posts.show', $post->slug) }}">
                        {{ $post->title }}
                    </a>
                </h2>

                <p class="mt-2 prose text-justify text-base text-gray-700 font-light">
                    {!! $post->getExcerpt() !!}<a class="no-underline text-blue-500"
                        href="{{ route('posts.show', $post->slug) }}">continue reading</a>
                </p>
                <div class="topics flex flex-wrap justify-start my-3 gap-y-2 gap-x-1 text-sm">
                    @php $count = 0; @endphp
                    @foreach ($post->tags as $tag)
                        @if ($count < 10)
                            <x-posts.tag-badge :tag="$tag" />
                            @php $count++; @endphp
                        @else
                        @break
                    @endif
                @endforeach
            </div>
            <div class="article-actions-bar flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <span class="text-gray-500 text-sm"> Posted {{ $post->published_at->diffForHumans() }}</span>
                </div>
                <div>
                    <livewire:like-button :key="'likebutton-' . $post->id . now()" :$post />
                </div>
            </div>
        </div>
    </div>
</article>
</div>
