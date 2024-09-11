<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Categories;
use App\Models\Comment;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all()->sortDesc();
        $categories = [];
        foreach ($posts as $key => $value) {
        	$categories[$value->id] = $value->categories();
        }
        return view('posts.index', [
        	'posts' => $posts,
        	'categories' => $categories
        ]);
    }

    public function create()
    {
        $categories = Categories::all();
        return view('posts.create')->with(['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $user_id = $request->input('id');
        $title = $request->input('title');
        $body = $request->input('body');
        $categories = $request->input('categories');


        $post = Post::create([
            'title' => $title,
            'body' => $body,
            'user_id' => $user_id,
        ]);

        if ($categories) {
            $category = Categories::find($categories);
            $post->categories()->attach($category->id);
        }

        return redirect('/dashboard')->with('success', 'Your post was added to feed');
    }

    public function show(string $id)
    {
        $post = Post::find($id);
        $comments = Comment::where('post_id', $id)->get();
       
        $names = $this->getNames($comments);

        if ($post) {
            return view('posts.show')->with([
                'post'=> $post,
                'comments' => $comments,
                'categories' => $post->categories(),
                'names' => $names
            ]);
        }

        return redirect('/dashboard')->with('error', 'Post not found!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);
        return view('posts.edit')->with('post', $post);
    }

    public function update(Request $request, string $id)
    {
       $post = Post::find($id);

       if ($request->request->get('title')) {
           $post->title = $request->request->get('title');
       }
       if ($request->request->get('body')) {
           $post->body = $request->request->get('body');
       }
       if ($request->request->get('categories')) {
           $post->categories()->sync($request->request->get('categories'));
       }
       
       $post->updated_at = new DateTime();

       $post->save();

       $new = Post::find($id);
       $comments = Comment::where('post_id', $new)->get();
       $names = $this->getNames($comments);

        return view('posts.show')->with([
                'post'=> $new,
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
        $category = Categories::find($id);
        $posts = $category->post()->get();
        return view('blog.main')->with('posts', $posts);
    }

    public function filterPostsByTitle(Request $request)
    {
        $search = $request->request->get('title');
        $posts = Post::where('title', 'LIKE', "%{$search}%")->orWhere('body','like',"%{$search}%")->get();
        return view('blog.main')->with('posts', $posts);
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
