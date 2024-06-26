<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'notice_id' => 'required',
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'notice_id' => $request->notice_id,
            'comment' => $request->description,
        ]);

        $this->flashSuccess('Your comment successfully added');

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'description' => 'required',
        ]);

        $comment->update([
            'comment' => $request->description,
        ]);

        $this->flashSuccess('Comment updated');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        $this->flashSuccess('Comment deleted');

        return back();
    }
}
