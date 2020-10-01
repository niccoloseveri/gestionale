<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Carbon\Traits\Timestamp;
use Faker\Provider\DateTime;
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
    public function store(Request $request ){
        $users=User::all();
        $this->validate($request,[
            'title'=>'required',
            'topic' =>'required',
            'author'=>'required',
            'data_p' => 'required',
            'ora_p' =>'required'

        ]);
        $data=date($request->input('data_p'));
        $ora=$request->input('ora_p');

        $article=new Articles;

        $article->title = $request->input('title');
        $article->topic = $request->input('topic');
        $article->author()->sync($request->users);
        $article->pubblicazione = $data.' '.$ora;

        $article->save();


        return redirect()->route('articles.index');
    }

    public function edit(Articles $article){
        //
        $users=User::all();
        return view('editArticle')->with([
            'articles'=>$article,
            'users'=>$users
        ]);
    }
    public function destroy(Articles $article)
    {
        $article->users()->detach();
        $article->delete();
        return redirect()->route('articles.index');
    }
    public function update(Request $request, Articles $article){
        $article->users()->sync($request->users);
        return redirect()->route('articles.index');
    }

}
