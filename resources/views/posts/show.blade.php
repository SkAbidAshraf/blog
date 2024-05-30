<x-app-layout title="{{ $post->title }}">
    <main class="container mx-auto px-5 grid grid-cols-12">
        <div id="left" class="col-span-12 lg:col-span-8 lg:px-5 lg:border-r border-gray-200">
            <article class="mt-5 mx-auto py-5 w-full" style="max-width:700px">
                <img class="w-full my-2 rounded-lg" src="{{ $post->getThumbnailImage() }}" alt="thumbnail">
                <h1 class="text-4xl font-bold my-5 text-gray-800">
                    {{ $post->title }}

                </h1>

                <div class="mt-2  border-t border-b border-gray-200 flex justify-between items-center">
                    <div class="flex py-4 text-base items-center">
                        <x-posts.author :author="$post->author" size="md" />
                        <span class="text-gray-500 text-sm">|
                            {{ $post->getReadingTime() <= 1 ? ' 1 minute' : $post->getReadingTime() }} read</span>
                    </div>
                    <div class="flex items-center">
                        <span class="text-gray-500 mr-2">{{ $post->published_at->diffForHumans() }} </span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.3"
                            stroke="currentColor" class="w-5 h-5 text-gray-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>

                <div class="article-content py-3 prose my-5 mb-8 text-gray-800 text-lg text-justify">
                    {!! str_replace('<img ', '<img style="margin-block: 1rem;" ', $post->content) !!}
                    <style>
                        figure {
                            pointer-events: none;

                            .attachment__size {
                                display: none;
                            }

                            .attachment__name {
                                display: none;
                            }

                            .attachment__caption {
                                text-decoration: none;
                            }
                        }
                    </style>
                </div>

                <div class="flex justify-between mt-5 border-t border-gray-200 pt-4">
                    <livewire:like-button :key="'likebutton-' . $post->id . now()" :$post />


                    <livewire:bookmark-button :key="'bookmarkbutton-' . $post->id . now()" :$post />

                </div>


                @php $count = 0; @endphp
                @foreach ($post->tags as $tag)
                    @php $count++; @endphp
                @endforeach
                @if ($count > 0)
                    <h2 class="text-2xl font-semibold border-t border-gray-200 text-gray-900 pt-4 mt-5 mb-1">Tags</h2>
                    <div class="article-actions-bar flex text-sm items-center justify-between border-gray-200 pt-3">

                        <div class="topics flex flex-wrap justify-start my-1 gap-y-2 gap-x-1 text-sm">
                            @foreach ($post->tags as $tag)
                                <x-posts.tag-badge :tag="$tag" />
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="mt-5 comments-box border-t border-gray-200 pt-5">
                    <div class="flex justify-between">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-5">Discussions</h2>
                        <div class="flex items-center  mb-5">
                        </div>
                    </div>
                    <livewire:post-comments :key="'comments' . $post->id" :$post>
                </div>

                <div class="w-full lg:hidden">
                    <h3 class="text-lg mb-3 font-semibold text-gray-900">Latest Posts</h3>
                    @foreach ($latestPosts as $post)
                        <x-posts.suggest-post-items :post="$post" />
                    @endforeach
                </div>

            </article>
        </div>

        <div id="rignt" class="col-span-12 hidden lg:block lg:col-span-4 xl:pl-20 lg:pl-10 pl-5">
            <div class="mt-5 py-5 pb-10 w-full space-y-10 overflow-hidden sticky top-0" style="min-height: 85vh;">

                <div class="w-full">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">About Author</h3>
                    <x-posts.author-details :author="$author" />

                </div>

                @include('posts.partials.tags-box')

                <div class="w-full">
                    <h3 class="text-lg mb-3 font-semibold text-gray-900">Latest Posts</h3>
                    @foreach ($latestPosts as $post)
                        <x-posts.suggest-post-items :post="$post" />
                    @endforeach
                </div>

            </div>
        </div>
    </main>
</x-app-layout>
