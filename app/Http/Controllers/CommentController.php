<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Lesson;

class CommentController extends Controller
{
    public function store(Request $request, Lesson $lesson)
{
    $request->validate([
        'comment' => 'required|string',
        'parent_id' => 'nullable|exists:comments,id',
    ]);

    Comment::create([
        'user_id' => auth()->id(),
        'lesson_id' => $lesson->id,
        'content' => $request->comment,
        'parent_id' => $request->parent_id, // Handle replies
    ]);

    return back()->with('success', 'Comment added successfully.');
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
