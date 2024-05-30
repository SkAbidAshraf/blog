<div class="flex">
    <a class="" href="{{ route('posts.index', ['author' => $author->id]) }}">
        <img class="w-20 h-20 rounded-full border border-gray-200 " src="{{ $author->profile_photo_url }}" alt="avatar">
    </a>
    <div class="ml-2 gap-y-1 flex flex-col justify-center">
        <div class="">Name: {{ $author->name }}</div>
        <div class="">Email: {{ $author->email }}</div>
    </div>

</div>
