<div>
    @auth
        <textarea wire:model='comment'
            class="w-full rounded-lg p-4 bg-gray-50 focus:outline-none text-sm text-gray-700 border-gray-200 placeholder:text-gray-400"
            cols="30" rows="5"></textarea>
        <button wire:click="postComment"
            class="mt-3 inline-flex items-center justify-center h-10 px-4 font-medium tracking-wide text-white transition duration-200 bg-gray-900 rounded-lg hover:bg-gray-800 focus:shadow-outline focus:outline-none">
            Post Comment
        </button>
    @else
        <div class="flex justify-center"><a wire:navigate class="text-blue-600 underline py-1 text-center"
                href="{{ route('login') }}"> Login to Post Comments</a></div>
    @endauth

    <div class="user-comments px-3 py-2 mt-5">
        @forelse ($this->comments as $comment)
            <div class="comment [&:not(:last-child)]:border-b border-gray-200 py-5">
                <div class="flex justify-between">
                    <div class="user-meta flex mb-4 text-sm items-center ">
                        <x-posts.author :author="$comment->user" size="sm" />
                        <span class="text-gray-500">. {{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="text-sm text-red-500 py-3">
                        @if (auth()->check() && auth()->user()->id === $comment->user_id)
                            <button wire:loading.attr='disabled' wire:click='deleteComment({{ $comment->id }})'
                                class="flex items-center">
                                <svg wire:loading.delay aria-hidden="true"
                                    class="w-5 h-5 text-gray-200 animate-spin dark:text-gray-600 fill-red-600"
                                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                        fill="currentColor" />
                                    <path
                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                        fill="currentFill" />
                                </svg>

                                <svg wire:loading.delay.remove xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        @endif
                        {{-- <button wire:loading.attr='disabled' wire:click='deleteComment({{ $comment->id }})'
                            class="flex items-center">
                            <svg wire:loading.delay aria-hidden="true"
                                class="w-5 h-5 text-gray-200 animate-spin dark:text-gray-600 fill-red-600"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>

                            <svg wire:loading.delay.remove xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor"
                                class="w-6 h-6 {{ !Auth::user() ? 'text-red-600  hover:text-red-400' : 'text-gray-600 hover:text-gray-900' }}  ">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    fill="{{ !Auth::user() ? 'currentColor' : 'none' }}"
                                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>
                            <span class="text-gray-600 ml-2">
                                1
                            </span>
                        </button> --}}

                    </div>
                </div>
                <div class="text-justify text-gray-700  text-sm">
                    {{ $comment->comment }}
                </div>

            </div>
        @empty
            <div class="text-gray-500 text-center">
                <span> No Comments Posted</span>
            </div>
        @endforelse
    </div>
    <div class="my-3 md:flex  md:justify-between">
        {{ $this->comments->onEachSide(1)->links('livewire.pagination-comment') }}
    </div>
</div>
