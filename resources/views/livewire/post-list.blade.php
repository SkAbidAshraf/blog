<div class="sm:px-3 px-1 lg:px-7 pt-3">
    <div class="sm:flex justify-between items-center border-b border-gray-200">
        <div class="text-gray-600 flex gap-x-2">
            @if ($this->activeTag)
                <div style="display: flex;">
                    Topic: <x-badge wire:navigate class="ml-1 rounded-xl px-3 border border-gray-200"
                        href="{{ route('posts.index', ['tag' => $this->activeTag->slug]) }}" :textColor="$this->activeTag->text_color"
                        :bgColor="$this->activeTag->bg_color">{{ $this->activeTag->title }}</x-badge>
                </div>
            @endif

            @if ($search)
                <div>Showing results for: <span class="italic"><strong>{{ $search }}</strong></span></div>
            @endif
            @if ($this->activeTag || $search)
                <button wire:click="clearTagSearch()" class="ml-1 flex items-center text-xs gray-500">
                    <svg class="w-4 h-4 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18 17.94 6M18 18 6.06 6" />
                    </svg>
                </button>
            @endif
            @if ($this->author)
                <div>Showing posts created by: <strong>{{ \App\Models\User::find($this->author)->name }}</strong></div>
                <button wire:click="clearTagSearch()" class="ml-1 flex items-center text-xs gray-500">
                    <svg class="w-4 h-4 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18 17.94 6M18 18 6.06 6" />
                    </svg>
                </button>
            @endif
            {{-- @if (!$this->activeTag && !$search)
                All posts
            @endif --}}
        </div>
        <div class="flex justify-end items-center space-x-4 font-light text-md">
            <button class="{{ $popular ? 'text-gray-900 border-b border-blue-500' : 'text-gray-500' }} py-3"
                wire:click="getPopularPosts()">Popular</button>
            <button class="{{ ($sort === 'desc' && !$popular) ? 'text-gray-900 border-b border-blue-500' : 'text-gray-500' }} py-3"
                wire:click="setSort('desc')">Latest</button>
            <button class="{{ $sort === 'asc' ? 'text-gray-900 border-b border-blue-500' : 'text-gray-500' }} py-3"
                wire:click="setSort('asc')">Oldest</button>
        </div>
    </div>
    <div class="pt-4">
        @php $count = 0;@endphp
        @foreach ($this->posts as $post)
            <x-posts.post-items :post="$post" />
            @php $count++; @endphp
        @endforeach
        @if ($count == 0)
            <div class="text-center text-gray-500">No posts found</div>
        @endif
    </div>
    <div class="my-3 md:flex  md:justify-between">
        {{ $this->posts->onEachSide(1)->links('livewire.pagination') }}
    </div>
</div>
