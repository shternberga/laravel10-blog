<x-blog-layout :categories="$categories">
    <!-- Post Section -->
    <section class="items-center space-y-4">
        <article class="flex flex-col shadow my-4">
            <!-- Article Image -->
            <a href="#" class="hover:opacity-75">
                <img src="{{ $post->media ? Storage::url($post->media) : Storage::url('public/media/noimage.webp') }}" width="590" height="332" class="object-cover"> </a>
            </a>
            <div class="bg-white flex flex-col justify-start p-6">
                @foreach ($post->categories as $category)
                <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">{{ $category->name }}</a>
                @endforeach
                <a href="#" class="text-3xl font-bold hover:text-gray-700 pb-4">{{ $post->title }}</a>
                <p href="#" class="text-sm pb-8">
                    By <a href="#" class="font-semibold hover:text-gray-800">{{ $post->user->name }}</a>, Published on {{ $post->created_at->format('F j, Y') }}
                </p>
                <div class="pb-3">{!! $post->body !!}</div>
            </div>
            <x-comments-section :post="$post" />
        </article>
    </section>
</x-blog-layout>