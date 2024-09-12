<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use DateTime;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        
		$posts = Post::select(
            'posts.*',
            DB::raw('(SELECT COUNT(*) FROM comments WHERE comments.post_id = posts.id) AS comment_count'),
            DB::raw('(SELECT name FROM users WHERE users.id = posts.user_id) AS post_author')
        )
        ->leftJoin('comments', 'comments.post_id', '=', 'posts.id')
        ->orderBy('posts.created_at', 'DESC')
        ->get();

        return view('posts.index', [
        	'posts' => $posts,
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('posts.create')->with(['categories' => $categories]);
    }

    public function store(Request $request)
    {
		$validator = Validator::make($request->all(), [
	        'title' => 'required|string|max:255',
	        'body' => 'required|string',
	        'user_id' => 'required|int',
	    ]);

	    if ($validator->fails()) {
	        return redirect()->back()
	            ->withErrors($validator);
	    }

        $user_id = $request->input('user_id');
        $title = $request->input('title');
        $body = $request->input('body');
        $values = $request->input('values');
        $categories = explode(',', $values);

        $post = Post::create([
            'title' => $title,
            'body' => $body,
            'user_id' => $user_id,
        ]);

        if ($categories && is_array($categories)) {
        	foreach ($categories as $key => $value) {
        		$category = Category::find($value);
        		$post->categories()->attach($category->id);
        	}
        }

        return redirect('/posts')->with('success', 'Your post was added to feed');
    }

    public function show(string $id)
    {
        $post = Post::find($id);
        $comments = Comment::where('post_id', $id)->get();
        $post_author = User::select('name')->where('id', $post->user_id)->first();
       
        $names = $this->getNames($comments);

        if ($post) {
            return view('posts.show')->with([
                'post'=> $post,
                'post_author' => $post_author,
                'comments' => $comments,
                'categories' => $post->categories()->get(),
                'names' => $names
            ]);
        }

        return redirect('/dashboard')->with('error', 'Post not found!');
    }

    public function edit(string $id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        return view('posts.edit')->with([
        	'post' => $post,
        	'categories' => $categories
        ]);
    }

    public function update(Request $request, string $id)
    {
       $post = Post::find($id);

		$validator = Validator::make($request->all(), [
	        'title' => 'required|string|max:255',
	        'body' => 'required|string',
	        'user_id' => 'required|int',
	    ]);

	    if ($validator->fails()) {
	        return redirect()->back()
	            ->withErrors($validator);
	    }
		
		$post->title = $request->request->get('title');
        $post->body = $request->request->get('body');
        $values = $request->request->get('values');
        $categories = explode(',', $values);

        $post->categories()->sync($categories);

        $post->updated_at = new DateTime();

        $post->save();

        $new = Post::find($id);
        $comments = Comment::where('post_id', $new)->get();
        $names = $this->getNames($comments);
        $categories = $post->categories()->get();
        $post_author = User::select('name')->where('id', $post->user_id)->first();

        return view('posts.show')->with([
                'post'=> $new,
                'post_author' => $post_author,
                'categories' => $categories,
                'comments' => $comments,
                'names' => $names
            ]);
    }

    public function destroy(string $id)
    {
         $post = Post::find($id);

        if ($post) {
            $post->categories()->detach();
            $post->delete();

            return redirect('/dashboard')->with('status', 'Post deleted!');
        } else {
            return redirect()->route('posts.show', ['post' => $id]);
        }
    }

    public function filterPostsByCategory(int $id)
    {
        $category = Category::find($id);
        $posts = $category->post()->get();

        return view('posts.index', [
        	'posts' => $posts,
        ]);
    }

    public function filterPostsByTitle(Request $request)
    {
        $search = $request->request->get('keyword');
        $posts = Post::select(
            'posts.*',
            DB::raw('(SELECT COUNT(*) FROM comments WHERE comments.post_id = posts.id) AS comment_count'),
            DB::raw('(SELECT name FROM users WHERE users.id = posts.user_id) AS post_author')
        )
        ->leftJoin('comments', 'comments.post_id', '=', 'posts.id')
        ->where('title', 'LIKE', "%{$search}%")->orWhere('body','like',"%{$search}%")
        ->orderBy('posts.created_at', 'DESC')
        ->get();

        return view('posts.index', [
        	'posts' => $posts,
        ]);
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
