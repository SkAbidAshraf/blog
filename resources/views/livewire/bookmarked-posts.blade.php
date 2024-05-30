<div class="w-50 sm:px-3 px-1 lg:px-7 pt-3">
    <div class="pt-4">
        @php $count = 0;@endphp
        @foreach ($posts as $post)
            <x-posts.post-items :post="$post" />
            @php $count++; @endphp
        @endforeach
        @if ($count == 0)
            <div class="text-center text-gray-500">No posts found</div>
        @endif
    </div>
    <div class="my-3 md:flex  md:justify-between">
        {{ $posts->links('livewire.pagination') }}
    </div>
</div>
