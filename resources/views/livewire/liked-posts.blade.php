<div class="sm:px-3 px-1 lg:px-7 pt-3">
    @foreach ($posts as $post)
        <x-posts.post-items :post="$post" />
    @endforeach
</div>
