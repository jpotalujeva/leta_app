<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use DateTime;
class CommentController extends Controller
{
    public function store(Request $request)
    {
        $user_id = $request->input('user_id');
        $post_id = $request->input('post_id');
        $comment = $request->input('comment');

        $data = Comment::create([
            'user_id' => $user_id,
            'post_id' => $post_id,
            'comment' => $comment,
        ]);

        $post = Post::find($post_id);
        $comments = Comment::where('post_id', $post_id)->get();
        $names = $this->getNames($comments);
        $categories = $post->categories()->get();
        $post_author = User::select('name')->where('id', $post->user_id)->first();

        if ($data) {
            return view('posts.show')->with([
                'post'=> $post,
                'post_author' => $post_author,
                'comments' => $comments,
                'categories' => $post->categories()->get(),
                'names' => $names
            ]);
        }

        return redirect('/dashboard')->with('status', 'Comment was not added');
    }

     public function destroy(string $id)
    {
         $comment = Comment::find($id);

        if ($comment) {
            $comment->delete();
            return redirect()->route('posts.index')->with('status', 'Comment deleted!');
        } else {
            return redirect('/posts')->with('status', 'Oops! Something went wrong!');
        }
    }

    private function getNames($comments)
    {
        $names = [];
        foreach ($comments as $key => $value) {
            $username = User::where('id', $value->user_id)->value('name');
            $names[$value->id] = $username;
        }
        return $names;
    }
}
