{{-- resources/views/components/post-card.blade.php --}}

<div id="post-card-{{ $post->id }}" class="bg-white shadow-md rounded border border-slate-200 p-5">
    <header class="flex justify-between items-start space-x-3 mb-3">
        <!-- Title -->
        <div class="flex items-start space-x-3">
            <div>
                <div class="leading-tight">
                    <a class="text-sm font-semibold text-slate-800" href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                </div>
                <div class="text-sm text-slate-500">{{ $post->created_at->format('M d, Y h:i A') }}</div>
            </div>
        </div>
        <!-- Menu button -->
        <div class="relative">
            <div class="absolute top-0 right-0 inline-flex" x-data="{ open: false }">
                <button class="rounded-full" :class="open ? 'bg-slate-100 text-slate-500': 'text-slate-400 hover:text-slate-500'" aria-haspopup="true" @click.prevent="open = !open" :aria-expanded="open">
                    <span class="sr-only">Menu</span>
                    <svg class="w-8 h-8 fill-current" viewBox="0 0 32 32">
                        <circle cx="16" cy="16" r="2" />
                        <circle cx="10" cy="16" r="2" />
                        <circle cx="22" cy="16" r="2" />
                    </svg>
                </button>
                <div class="origin-top-right z-10 absolute top-full right-0 min-w-36 bg-white border border-slate-200 py-1.5 rounded shadow-lg overflow-hidden mt-1" @click.outside="open = false" @keydown.escape.window="open = false" x-show="open" x-transition:enter="transition ease-out duration-200 transform" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-out duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-cloak>
                    <ul>
                        <li>
                            <form method="POST" action="{{ route('posts.destroy', $post->id) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-medium text-sm text-rose-500 hover:text-rose-600 flex py-1 px-3">{{ __('Remove') }}</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <!-- Category Badges -->
    <div class="mb-3">
        @foreach ($post->categories as $category)
        <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-semibold leading-none text-white bg-indigo-500 rounded-full">{{ $category->name }}</span>
        @endforeach
    </div>
    <!-- Post Body -->
    <a href="{{ route('posts.show', $post->id) }}" class="block hover:bg-gray-50 transition-colors duration-200 rounded-lg">
        <div class="text-sm text-slate-800 space-y-2 mb-5">
            <p class="text-gray-600">{{ $post->body }}</p>
            @if($post->media)
            <div class="relative !my-4">
                <img class="block w-full" src="{{ Storage::url($post->media) }}" width="590" height="332" alt="{{ $post->title }}" />
            </div>
            @endif
        </div>
    </a>
    <footer class="flex items-center space-x-4">
        <a href="{{ route('posts.edit', $post->id) }}">
            <button class="flex items-center text-slate-400 hover:text-indigo-500">
                <svg class="w-4 h-4 shrink-0 fill-current mr-1.5" viewBox="0 0 16 16">
                    <path d="M11.7.3c-.4-.4-1-.4-1.4 0l-10 10c-.2.2-.3.4-.3.7v4c0 .6.4 1 1 1h4c.3 0 .5-.1.7-.3l10-10c.4-.4.4-1 0-1.4l-4-4zM4.6 14H2v-2.6l6-6L10.6 8l-6 6zM12 6.6L9.4 4 11 2.4 13.6 5 12 6.6z" />
                </svg>

                <div class="text-sm text-slate-500">{{ __('Edit') }}</div>
            </button>
        </a>
        <!-- Comments button -->
        <button class="flex items-center text-slate-400 hover:text-indigo-500">
            <svg class="w-4 h-4 shrink-0 fill-current mr-1.5" viewBox="0 0 16 16">
                <path d="M8 0C3.6 0 0 3.1 0 7s3.6 7 8 7h.6l5.4 2v-4.4c1.2-1.2 2-2.8 2-4.6 0-3.9-3.6-7-8-7zm4 10.8v2.3L8.9 12H8c-3.3 0-6-2.2-6-5s2.7-5 6-5 6 2.2 6 5c0 2.2-2 3.8-2 3.8z" />
            </svg>
            <div class="text-sm text-slate-500">{{ $post->comments->count() }}</div>
        </button>
    </footer>

    <x-comments-section :post="$post" />
</div>