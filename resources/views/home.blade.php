<x-app-layout title="Home">
    @section('hero')
        <div class="w-full text-center py-32 bg-cover bg-center bg-no-repeat overflow-hidden"
            style="background-image: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.75)),
            url('images/banner.jpg');">
            <h1 class="text-3xl md:text-4xl font-bold text-center lg:text-5xl text-sky-100">
                Welcome to <span class="text-blue-600">DailyTech</span>
            </h1>
            <p class="text-sky-100 text-xl font-bold my-5">The Best Tech Blog out there</p>
            <a class="px-3 py-2 text-lg text-white bg-gray-800 rounded inline-block" href="{{ route('posts.index') }}">
                Start Reading
            </a>
        </div>
    @endsection

    <div class="pt-1 pb-8 mx-auto md:px-16 sm:px-10 px-3 w-full">

        @if ($featuredPosts->count() >= 1)
            <div class="mb-8">
                <h2 class="my-8 text-3xl text-blue-600 font-bold">Featured Posts</h2>
                <div class="w-full">
                    <div class="grid lg:grid-cols-4 grid-cols-2 gap-8 w-full">
                        @foreach ($featuredPosts as $post)
                            <x-posts.post-card :post="$post" class="sm:col-span-1 col-span-3" />
                        @endforeach
                    </div>
                </div>
                {{-- <a class="mt-10 block text-center text-lg text-blue-600 font-semibold"
                    href="http://127.0.0.1:8000/blog">More
                    Posts</a> --}}
            </div>
        @endif
        <hr>

        <livewire:home />
        
    </div>

</x-app-layout>
