<?php

namespace App\Http\Controllers;

use App\Models\CommentReply;
use Illuminate\Http\Request;

class ReplyController extends Controller
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
            'comment' => 'required',
            'notice' => 'required',
        ]);

        CommentReply::create([
            'notice_id' => $request->notice,
            'comment_id' => $request->comment,
            'user_id' => auth()->id(),
            'comment' => $request->description,
        ]);

        $this->flashSuccess('Your reply added');

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommentReply $reply)
    {
        $request->validate([
            'comment' => 'required',
        ]);

        $reply->update([
            'comment' => $request->comment,
        ]);

        $this->flashSuccess('The reply is updated');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommentReply $reply)
    {
        $reply->delete();

        $this->flashSuccess('The reply is deleted');

        return back();
    }
}
