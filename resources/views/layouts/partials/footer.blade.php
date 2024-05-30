<footer class="text-sm space-x-4 flex items-center border-t border-gray-100 flex-wrap justify-center py-4">
    <a class="text-gray-500 hover:text-blue-600" href="">About Us</a>
    <a class="text-gray-500 hover:text-blue-600" wire:navigate href=" {{ __('policy') }} ">Policy</a>
    <a class="text-gray-500 hover:text-blue-600" wire:navigate href=" {{ __('login') }} ">Login</a>
    <a class="text-gray-500 hover:text-blue-600" wire:navigate href="{{ route('posts.index') }}" :active="request()->routeIs('posts.index')">Explore</a>
</footer>
