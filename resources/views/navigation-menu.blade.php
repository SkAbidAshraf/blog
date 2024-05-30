<nav class="flex items-center justify-between bg-sky-100 py-3 px-6 border-b border-gray-100 ">
    <div id="nav-left" class="">
        <a wire:navigate href="{{ route('home') }}">
            <x-application-mark class="block h-9 w-auto" />
        </a>
    </div>

    <div class="top-menu text-center mx-auto">
        <div class="flex md:space-x-8 space-x-4">
            <x-nav-link class="text-base" href="{{ route('home') }}" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-nav-link>
            <x-nav-link href="{{ route('posts.index') }}" :active="request()->routeIs('posts.index')">
                {{ __('Posts') }}
            </x-nav-link>
            <x-nav-link href="{{ route('about-us') }}" :active="request()->routeIs('about-us')">
                {{ __('About Us') }}
            </x-nav-link>
        </div>
    </div>

    <div id="nav-right" class="flex items-center  md:space-x-6 space-x-4">
        @auth
            @include('layouts.partials.header-right-auth')
        @else
            @include('layouts.partials.header-right-guest')
        @endauth
    </div>
</nav>
