{{-- resources/views/pages/posts/index.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Posts') }}
        </h2>
    </x-slot>
    <div class="flex-1 max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="md:py-8">
            @if(session('success'))
            <div class="mb-4 text-sm text-green-600">
                {{ session('success') }}
            </div>
            @endif
            <div class="space-y-4">
                <!-- Add Post Form -->
                <x-post-form :categories="$categories" />

                <!-- Existing Posts -->
                @foreach ($posts as $post)
                <x-post-card :post="$post" />
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>