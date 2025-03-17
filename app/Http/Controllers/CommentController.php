<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $lessonId)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'lesson_id' => $lessonId,
            'content' => $request->comment,
        ]);

        return back()->with('success', 'Comment added successfully!');
    }

    public function update(Request $request, Comment $comment)
    {
        // Ensure only the owner can edit
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'comment' => 'required|string',
        ]);

        $comment->update([
            'content' => $request->comment,
        ]);

        return back()->with('success', 'Comment updated successfully!');
    }

    public function destroy(Comment $comment)
    {
        // Ensure only the owner can delete
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $comment->delete();

        return back()->with('success', 'Comment deleted successfully!');
    }
}
