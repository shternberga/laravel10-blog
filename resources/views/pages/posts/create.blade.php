{{-- resources/views/pages/posts/create.blade.php --}}

<x-app-layout>
    <h1>Create Post</h1>
    <form method="POST" action="{{ route('posts.store') }}">
        @csrf
        <div>
            <label>Title:</label>
            <input type="text" name="title" value="{{ old('title') }}">
            @error('title')
            <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label>Body:</label>
            <textarea name="body">{{ old('body') }}</textarea>
            @error('body')
            <div>{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Create Post</button>
    </form>
</x-app-layout>