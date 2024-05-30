<div>
    @if (count($posts) > 0)
        <div>
            <h2 class="my-8 text-3xl text-blue-600 font-bold">Latest Posts</h2>
            <div class="w-full">
                <div class="grid lg:grid-cols-4 grid-cols-2 gap-8 w-full">
                    @foreach ($posts as $post)
                        <x-posts.post-card :post="$post" class="sm:col-span-1 col-span-3" />
                    @endforeach
                </div>
            </div>
            @unless ($allPostsLoaded)
                <div class="flex justify-center">
                    <button wire:click="loadMore" class=" mt-10 text-center text-lg text-blue-600 font-semibold">Load
                        More</button>
                </div>
            @endunless
        </div>
    @endif
</div>
