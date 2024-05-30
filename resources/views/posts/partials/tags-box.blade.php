<div>
    <h3 class="text-lg font-semibold text-gray-900 mb-3">Recommended Topics</h3>
    <div class="topics flex flex-wrap justify-start gap-y-2 gap-x-1 text-base">
        @foreach ($tags as $tag)
            <x-posts.tag-badge :tag="$tag" />
        @endforeach
    </div>
</div>
