<x-app-layout title="Posts">

    <div class="sm:px-3 px-1 lg:px-7 pt-3">

        <div class="sm:px-3 px-1 lg:px-7 pt-3">
            <div class="sm:flex justify-center items-center border-b border-gray-200">

                <div class="flex justify-end items-center space-x-10 font-light text-md">

                    @php
                        $currentRoute = Route::currentRouteName();
                    @endphp

                    <a  href="{{ route('history.bookmarked-posts') }}"
                        class="py-3 border-b {{ $currentRoute == ('history.bookmarked-posts') || $currentRoute == ('history') ? 'text-gray-900 border-blue-500' : 'text-gray-500 border-transparent' }}">
                        Bookmarked Posts
                    </a>
                    <a href="{{ route('history.liked-posts') }}"
                        class="py-3 {{ $currentRoute == 'history.liked-posts' ? 'text-gray-900 border-b border-blue-500' : 'text-gray-500' }}">
                        Liked Posts
                    </a>
                    {{-- <a href="{{ route('history.commented-posts') }}"
                        class="py-3 {{ $currentRoute == 'history.commented-posts' ? 'text-gray-900 border-b border-blue-500' : 'text-gray-500' }}">
                        Commented Posts
                    </a> --}}

                </div>
            </div>

            <div class="mx-auto">
                @yield('content')
            </div>

        </div>

    </div>

</x-app-layout>
