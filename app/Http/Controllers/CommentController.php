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
}
