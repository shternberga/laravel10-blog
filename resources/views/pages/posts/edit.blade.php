{{-- resources/views/pages/posts/index.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <a class="inline-flex items-center px-2 py-1 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-400 hover:bg-indigo-600" href="{{ route('posts.index') }}">
            <svg class="fill-current text-white mr-2" width="7" height="12" viewBox="0 0 7 12">
                <path d="M5.4.6 6.8 2l-4 4 4 4-1.4 1.4L0 6z" />
            </svg>
            <span>{{ __('Back To Posts') }}</span>
        </a>
    </x-slot>

    <div class="flex-1 max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="md:py-8">
            <div class="space-y-4 ">
                <x-post-form :post="$post" :categories="$categories" />
            </div>
        </div>
    </div>

</x-app-layout>