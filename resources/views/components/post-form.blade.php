<div class="bg-white shadow-md rounded border border-slate-200 p-5">
    <h2 class="text-lg font-bold mb-4">{{ $isEdit ? 'Edit the Post' : 'Create new Post' }}</h2>
    <form method="POST" action="{{ $isEdit ? route('posts.update', $post) : route('posts.store') }}" enctype="multipart/form-data">
        @csrf
        @if($isEdit) @method('PUT') @endif

        <div class="mb-5">
            <ul class="flex flex-wrap -m-1">
                @foreach ($categories as $category)
                <li class="m-1">
                    <button type="button" data-category-id="{{ $category->id }}" class="category-btn inline-flex items-center justify-center text-sm font-medium leading-5 rounded-full px-3 py-1 border border-transparent shadow-sm {{ $post && $post->categories->contains($category->id) ? 'bg-indigo-700' : 'bg-indigo-300' }} text-white duration-150 ease-in-out">{{ $category->name }}</button>
                </li>
                @endforeach
            </ul>
        </div>
        <input type="hidden" name="categories" id="selected-categories" value="">
        <div class="mb-4">
            <input id="title-input" class="form-input w-full bg-slate-100 border-transparent focus:bg-white placeholder-slate-500" type="text" name="title" placeholder="Your post title..." value="{{ old('title', $post->title ?? 'Your post title...') }}">
            @error('title')
            <div>{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="body-input" class="sr-only">Body</label>
            <textarea id="body-input" class="form-input w-full bg-slate-100 border-transparent focus:bg-white placeholder-slate-500" name="body" placeholder="Your new post content...">{{ old('body', $post->body ?? 'Your new post content') }}</textarea>
            @error('body')
            <div>{{ $message }}</div>
            @enderror
        </div>
        <div id="media-preview-container" class="hidden relative my-4">
            <img id="media-preview" class="block w-full" src="" alt="Media preview" />
        </div>
        <div class="flex justify-between items-center">
            <div class="grow flex space-x-5">
                <button type="button" id="media-button" class="inline-flex items-center text-sm font-medium text-slate-600 hover:text-slate-700">
                    <svg class="w-4 h-4 fill-indigo-400 mr-2" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11 0c1.3 0 2.6.5 3.5 1.5 1 .9 1.5 2.2 1.5 3.5 0 1.3-.5 2.6-1.4 3.5l-1.2 1.2c-.2.2-.5.3-.7.3-.2 0-.5-.1-.7-.3-.4-.4-.4-1 0-1.4l1.1-1.2c.6-.5.9-1.3.9-2.1s-.3-1.6-.9-2.2C12 1.7 10 1.7 8.9 2.8L7.7 4c-.4.4-1 .4-1.4 0-.4-.4-.4-1 0-1.4l1.2-1.1C8.4.5 9.7 0 11 0zM8.3 12c.4-.4 1-.5 1.4-.1.4.4.4 1 0 1.4l-1.2 1.2C7.6 15.5 6.3 16 5 16c-1.3 0-2.6-.5-3.5-1.5C.5 13.6 0 12.3 0 11c0-1.3.5-2.6 1.5-3.5l1.1-1.2c.4-.4 1-.4 1.4 0 .4.4.4 1 0 1.4L2.9 8.9c-.6.5-.9 1.3-.9 2.1s.3 1.6.9 2.2c1.1 1.1 3.1 1.1 4.2 0L8.3 12zm1.1-6.8c.4-.4 1-.4 1.4 0 .4.4.4 1 0 1.4l-4.2 4.2c-.2.2-.5.3-.7.3-.2 0-.5-.1-.7-.3-.4-.4-.4-1 0-1.4l4.2-4.2z" />
                    </svg>
                    <span>Media</span>
                </button>
                <input id="media-input" type="file" name="media" class="hidden">
            </div>
            <x-primary-button x-on:click="$dispatch('submit')">
                {{ $isEdit ? 'Update' : 'Submit' }} &gt;
            </x-primary-button>
        </div>
    </form>
</div>


@if($isEdit)
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var output = document.getElementById('media-preview');
        var container = document.getElementById('media-preview-container');
        var existingMedia = "{{ $post->media ? Storage::url($post->media) : '' }}";

        if (existingMedia) {
            output.src = existingMedia;
            container.classList.remove('hidden');
        }
    });
</script>
@endif
<script>
    document.getElementById('media-button').addEventListener('click', function() {
        const mediaInput = document.getElementById('media-input');

        if (!mediaInput.getAttribute('data-has-listener')) {
            mediaInput.addEventListener('change', function(event) {
                var output = document.getElementById('media-preview');
                var container = document.getElementById('media-preview-container');

                if (event.target.files && event.target.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        output.src = e.target.result;
                        container.classList.remove('hidden');
                    };

                    reader.readAsDataURL(event.target.files[0]);
                }
            });

            mediaInput.setAttribute('data-has-listener', 'true');
        }

        mediaInput.click();
    });
</script>
<script>
    let selectedCategories = [];

    document.addEventListener('DOMContentLoaded', function() {
        const categoryButtons = document.querySelectorAll('.category-btn');

        // Initialize selectedCategories with already selected categories
        categoryButtons.forEach(button => {
            if (button.classList.contains('bg-indigo-700')) {
                selectedCategories.push(button.dataset.categoryId);
            }
        });

        categoryButtons.forEach(button => {
            button.addEventListener('click', function() {
                const categoryId = this.dataset.categoryId;
                const isSelected = selectedCategories.includes(categoryId);

                if (isSelected) {
                    selectedCategories = selectedCategories.filter(id => id !== categoryId);
                    this.classList.replace('bg-indigo-700', 'bg-indigo-300');
                } else {
                    selectedCategories.push(categoryId);
                    this.classList.replace('bg-indigo-300', 'bg-indigo-700');
                }

                // Update the input field
                document.getElementById('selected-categories').value = selectedCategories.join(',').replace(/,$/, '');
            });
        });
    });
</script>