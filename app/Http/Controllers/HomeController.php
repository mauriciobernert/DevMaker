<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function change(Request $request) {
        // $this->validate($request, [
        //     'old' => 'required',
        //     'password' => 'required|min:6|confirmed',
        // ]);
 
        $user = User::find(Auth::id());
        $hashedPassword = $user->password;
 
        if ($request->password != $request->old) {

            if (Hash::check($request->old, $hashedPassword)) {
                $user->password = Hash::make($request->password);
                $user->save();
    
                $request->session()->put('success', 'Sua senha foi alterada!');
    
                return back();
            }
        }
 
        $request->session()->put('failure', 'Alguma coisa deu errado, tente novamente. Lembre que a senha nova deve ser diferente da antiga.');

        return back();
 
    }
}
