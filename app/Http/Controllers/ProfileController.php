<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Models\Post;
use App\Models\User;

class ProfileController extends Controller
{

   public function index(Request $request)
    {
        $id = Auth::id();

        $posts = Post::select(
              'posts.*',
               DB::raw('(SELECT COUNT(*) FROM comments WHERE comments.post_id = posts.id) AS comment_count'),
               DB::raw('(SELECT name FROM users WHERE users.id = posts.user_id) AS post_author')
            )
            ->leftJoin('comments', 'comments.post_id', '=', 'posts.id')
            ->where('posts.user_id', $id)
            ->orderBy('posts.created_at', 'DESC')
            ->get();

        return view('profile.index')->with([
            'posts' => $posts
        ]);
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
