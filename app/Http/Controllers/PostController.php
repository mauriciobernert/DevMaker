<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getList() {
        return view('list')->with(['list' => App\Post::all()]);
    }

    public function getFavorites() {
        return view('list')->with(['list' => Auth::user()->favorites()]);
    }

    public function postNew(Request $request) {
        $post = new Post;
        $post->text = $request->text;
        $post->user()->associate(Auth::user());
        $post->save();
    }

    public function favorite($id) {
        $user = Auth::user();
        $changes = $user->favorites()->toggle($id);
        $user->save();

        return response()->json(['changes' => $changes]);
    }
}
