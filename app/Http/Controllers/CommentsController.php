<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\News;
use App\Comment;

class CommentsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $request->validate([
            'content' => 'required|max:500',
        ]);

        $news = News::find($request->newsID);

        $comment = new Comment(['content'=>$request->content, 'user_id'=>Auth::user()->id]);

        $news->comments()->save($comment);

        return redirect()->back()->with('message', 'Comment added successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id)->delete();

        return redirect()->back()->with('message', 'Comment deleted successfully');
    }
}
