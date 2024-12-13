<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $productId)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'product_id' => $productId,
            'content' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'نظر شما ثبت شد!');
    }
    public function pendingComments()
    {
        $comments = Comment::where('is_approved', false)->get();
        return view('admin.comments.pending', compact('comments'));
    }

    public function approve($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->is_approved = true;
        $comment->save();

        return redirect()->back()->with('success', 'نظر تأیید شد.');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->back()->with('success', 'نظر حذف شد.');
    }
}
