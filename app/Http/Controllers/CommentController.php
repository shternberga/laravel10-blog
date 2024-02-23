<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function update(Request $request, Comment $comment)
    {
        $this->validate($request, [
            'body' => 'required',
        ]);

        $this->authorize('update', $comment);

        $comment->body = $request->body;
        $comment->save();

        return back();
    }
}
