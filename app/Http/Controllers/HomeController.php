<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Gate;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }
        else{
            $users=User::all();
            $articles=Articles::all();
         return view('home')->with('users',$users)->with('articles',$articles);}
    }
    public function create(){
        $users=User::all();
        return view('createArticle')->with('users',$users);
    }
    public function store(){
        $users=User::all();
        return view('createArticle')->with('users',$users);
    }

    public function edit(){
        //
    }
    public function destroy()
    {
        //
    }
}
