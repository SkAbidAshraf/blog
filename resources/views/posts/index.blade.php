<x-app-layout title="Posts">

    <div class="w-full px-5 grid md:grid-cols-4 grid-cols-3 gap-1 mx-auto d-flex" >

        <div id="side-bar" class="md:border-t-none lg:hidden block col-span-4 px-3 md:px-6 space-y-10 py-6 pt-10 top-0">
            <livewire:search-box />
            @include('posts.partials.tags-box')
        </div>

        <div class="lg:col-span-3 col-span-4 lg:border-r  border-gray-200 ">
            <livewire:post-list />
        </div>

        <div id="side-bar" class="md:border-t-none lg:block hidden col-span-3 sm:col-span-1 px-3 md:px-6  space-y-10 py-6 pt-10 overflow-hidden sticky top-0" style="height: 85vh">
            <livewire:search-box />

            @include('posts.partials.tags-box')
        </div>

    </div>

</x-app-layout>
