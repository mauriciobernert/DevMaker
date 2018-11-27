<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;
use DB;

class PostController extends Controller
{
    public function getList() {
        $posts = DB::table('posts')
            ->select('posts.id', 'posts.title', 'posts.text', 'users.name',
                DB::raw('(CASE WHEN favorites.user_id = ' . Auth::id() . ' THEN 1 ELSE 0 END) AS is_user'))
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->leftJoin('favorites', function ($join) {
                $join->on('posts.id', '=', 'favorites.post_id');
            })->get();
        return view('home')->with(['list' => $posts, 'favs' => false]);
    }

    public function getFavorites() {
        $posts = DB::table('posts')
            ->select('posts.id', 'posts.title' ,'posts.text', 'users.name',
                DB::raw('1 as is_user'))
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->join('favorites', 'favorites.post_id', '=', 'posts.id')
            ->get();

        return view('home')->with(['list' => $posts, 'favs' => true]);
    }

    public function postNew(Request $request) {
        $post = new Post;
        $post->title = $request->title;
        $post->text = $request->text;
        $post->user()->associate(Auth::user());
        $post->save();

        return redirect()->route('home');
    }

    public function favorite($id) {
        $user = Auth::user();
        $fav = $user->favorites()->where('post_id', $id)->first();
        if(is_null($fav))
            $user->favorites()->attach($id);
        else    
            $user->favorites()->detach($id);
        return back();
        // $changes = $user->favorites()->toggle($id);
        // $user->save();
        // return back()->with(['changes' => $changes]);
    }
}
