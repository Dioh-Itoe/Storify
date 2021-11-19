<?php

namespace App\Http\Controllers\stories;

use App\Models\Story;
use App\Models\Comment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FrontStoriesController extends Controller
{
    public function allstories(){
        $recent_story= Story::where('status', 1)->orderBy('created_at', 'desc')->first();
        $stories = Story::with(['users','category'])->where('status', 1)->orderBy('created_at', 'desc')->get();

        return view('welcome', compact('stories','recent_story'));
    }

    public function singleStory($slug){
        $story = Story::where('slug', $slug)->first();
        $comments = Comment::where('commentable_id', $story->id)->get();

        return view('single-story', compact('story', 'comments'));

    }

    // STORY COMMENTS STARTS
    public function addComment(Request $req, $id){
        $req->validate([
            'name' => 'required',
            'email' => 'required|email',
            'comment_body' => 'required'
        ]);
        
        $story = Story::where('id', $req->commentable_id)->first();
        // $comment = Comment::with('replies')->where('id', $req->parent_id)->first();

        if (Auth::check()) {
            $new_comment = new Comment;
            $new_comment->name              = $story->users->name;
            // $new_comment->slug              = $story->users->slug;
            $new_comment->author_id         = $story->users->id;
            $new_comment->email             = $story->users->email;
            // $new_comment->parent_id         = $story->comments->id;
            $new_comment->comment_body      = $req->comment_body;
            $new_comment->commentable_id    = $story->id;
            $new_comment->commentable_type  = 'App\Models\Story';
            $new_comment->save();
        } else {
            $comment = new Comment;
            $comment->name              = $req->name;
            // $comment->slug              = Str::slug($req->name);
            $comment->email             = $req->email;
            // $comment->parent_id         = $story->comments->id;
            $comment->comment_body      = $req->comment_body;
            $comment->commentable_id    = $story->id;
            $comment->commentable_type  = 'App\Models\Story';
            $comment->save();
        }
        

        return back()->with('success', 'Comment sent!');
    }

    // SAVING COMMENTS
    public function saveReply(Request $req, $id){
        $req->validate([
            'name' => 'required',
            'email' => 'required|email',
            'comment_body' => 'required'
        ]);
        
        $story = Story::where('id', $req->commentable_id)->get();
        // $comments = Comment::where('commentable_id', $story->id)->get();
        $comment = Comment::where('parent_id', $req->parent_id)->with('replies')->get();

        if (Auth::check()) {
            $new_comment = new Comment;
            $new_comment->name              = $req->name;
            // $new_comment->slug              = $story->users->slug;
            $new_comment->author_id         = $req->author_id;
            $new_comment->email             = $req->email;
            $new_comment->parent_id         = $req->parent_id;
            $new_comment->comment_body      = $req->comment_body;
            $new_comment->commentable_id    = $req->commentable_id;
            $new_comment->commentable_type  = 'App\Models\Story';
            $new_comment->save();
        } else {
            $comment = new Comment;
            $comment->name              = $req->name;
            // $comment->slug              = Str::slug($req->name);
            $comment->email             = $req->email;
            $comment->parent_id         = $req->parent_id;
            $comment->comment_body      = $req->comment_body;
            $comment->commentable_id    = $req->commentable_id;
            $comment->commentable_type  = 'App\Models\Story';
            $comment->save();
        }
        

        return back()->with('success', 'Comment replies!');
    }

    // STORY COMMENTS END
}
