<!-- Comments -->
<!-- Comment form -->
@auth
<div class="p-6">
    <form method="POST" action="{{ route('posts.comments.store', $post->id) }}">
        @csrf
        <div class="flex items-start space-x-3 mb-3">
            <div class="flex items-center">
                <!-- User icon and name -->
            </div>
            <div class="flex-grow">
                <label for="body" class="sr-only">{{ __('Write a comment…') }}</label>
                <textarea id="body" class="form-textarea w-full focus:border-slate-300" name="body" placeholder="Write a comment…">{{ old('body') }}</textarea>
                @error('body')
                <div>{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="text-right">
            <button type="submit" class="rounded p-1 btn-sm bg-indigo-500 hover:bg-indigo-600 text-white whitespace-nowrap">{{ __('Reply') }} &rarr;</button>
        </div>
    </form>
</div>
@endauth
@if ($post->comments->count())
<div class="p-6">
    <h3 class="font-semibold text-slate-800 mb-4">Comments</h3>
    <ul class="space-y-5">
        @foreach($post->comments as $comment)
        <!-- Comment -->
        <li class="relative pl-9 space-y-5">
            <!-- Comment wrapper -->
            <div class="flex items-start">
                <!-- Comment content -->
                <div>
                    <!-- Comment text -->
                    <div class="grow text-sm text-slate-800 space-y-2 mb-2">
                        <p>{{ $comment->body }}</p>
                    </div>
                    <!-- Comment footer -->
                    <div class="flex flex-wrap text-xs">
                        <div class="flex items-center after:block after:content-['·'] last:after:content-[''] after:text-sm after:text-slate-400 after:text-slate-600 after:px-2">
                            <a class="block mr-2" href="#0">
                                <i class="fas fa-user rounded-full" style="font-size: 12px;"></i> </a>
                            <a class="font-medium text-indigo-500 hover:text-indigo-600" href="#0">{{ $comment->user->name }}</a>
                        </div>
                        @if(Auth::check() && Auth::user()->id == $comment->user_id)
                        <div class="flex items-center after:block after:content-['·'] last:after:content-[''] after:text-sm after:text-slate-400 after:px-2">
                            <a class="font-medium text-slate-500 hover:text-slate-600" href="#0" onclick="editComment({{ $comment->id }})">Edit</a>
                        </div>
                        @endif
                    </div>

                    <!-- Comment text -->
                    <div id="comment-text-{{ $comment->id }}">
                        {{ $comment->text }}
                    </div>

                    <!-- Edit comment form -->
                    <div id="edit-comment-{{ $comment->id }}" style="display: none;">
                        <form method="POST" action="/comments/{{ $comment->id }}" style="width: 100%;">
                            @csrf
                            @method('PUT')
                            <div class="flex items-start space-x-3 mb-3">
                                <div class="flex-grow">
                                    <label for="body" class="sr-only">{{ __('Write a comment…') }}</label>
                                    <textarea id="body" class="form-textarea w-full focus:border-slate-300" name="body" required>{{ $comment->body }}</textarea>
                                    @error('body')
                                    <div>{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="rounded p-1 btn-sm bg-indigo-500 hover:bg-indigo-600 text-white whitespace-nowrap">{{ __('Reply') }} &rarr;</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
</div>
@endif

<script>
    function editComment(id) {
        document.getElementById('comment-text-' + id).style.display = 'none';
        document.getElementById('edit-comment-' + id).style.display = 'block';
    }
</script>