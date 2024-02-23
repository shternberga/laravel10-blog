<x-blog-layout :categories="$categories">
    <!-- Posts Section -->
    <section class="items-center space-y-4">
        @foreach ($posts as $post)
        <article class="flex flex-col shadow my-4">
            <!-- Article Image -->
            <a href="{{ route('blog.posts.show', $post->id) }}" class="hover:opacity-75">

                <img src="{{ $post->media ? Storage::url($post->media) : Storage::url('public/media/noimage.webp') }}" width="590" height="332" class="object-cover"> </a>
            <div class="bg-white flex flex-col justify-start p-6">
                <a href="{{ route('blog.posts.show', $post->id) }}" class="text-3xl font-bold hover:text-gray-700 pb-4">{{ $post->title }}</a>
                <p href="#" class="text-sm pb-3">
                    By <a href="#" class="font-semibold hover:text-gray-800">{{ $post->user->name }}</a>, Published on {{ $post->created_at->format('F j, Y') }}
                </p>
                <a href="{{ route('blog.posts.show', $post->id) }}" class="pb-6">{{ Str::limit($post->body, 250) }}</a>
                <a href="{{ route('blog.posts.show', $post->id) }}" class="uppercase text-gray-800 hover:text-black">Continue Reading <i class="fas fa-arrow-right"></i></a>
            </div>
        </article>
        @endforeach

        <!-- Pagination -->
        <div class="items-center space-y-4">
            {{ $posts->appends(request()->query())->links() }}
        </div>

    </section>
</x-blog-layout>