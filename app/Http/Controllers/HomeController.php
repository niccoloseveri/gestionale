<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Carbon\Traits\Timestamp;
use Faker\Provider\DateTime;
use Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;

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
            $articles=Articles::all()->sortByDesc('created_at');
         return view('home')->with('users',$users)->with('articles',$articles);}
    }
    public function create(){
        $users=User::all();
        $topics=Topic::all();
        return view('createArticle')->with('users',$users)->with('topics', $topics);
    }
    public function store(Request $request){
       // $user=Auth::user();
        $this->validate($request,[

            'title'=>'required',
           // 'topic' =>'required',
           // 'author'=>'required',
            'data_p' => 'required',
            'ora_p' =>'required'

        ]);

        $article=new Articles;

        $article->title = $request->input('title');
        //$article->topic = $request->input('topic');
        $article->data_p = $request->input('data_p');
        $article->ora_p = $request->input('ora_p');
        $article->save();
        if($request->topic=='other'){
        $article->topic()->firstOrCreate(array('name'=>$request->input('o_topic')));
        }else{
        $article->topic()->sync($request->topic);
        }
        if($request->author==""){
            $article->users()->sync(Auth::id());
        }else{
        $article->users()->sync($request->author);
        }
        return redirect()->route('articles.index');
    }

    public function edit(Articles $article){
        //
        $users=User::all();
        $topics=TOpic::all();
        return view('editArticle')->with([
            'articles'=>$article,
            'users'=>$users,
            'topics'=>$topics,
        ]);
    }
    public function destroy(Articles $article)
    {
        $article->users()->detach();
        $article->delete();
        return redirect()->route('articles.index');
    }
    public function update(Request $request, Articles $article){

        $article->title = $request->title;
        if($request->data_p!='' && $request->ora_p!=''){
            $article->data_p = date($request->data_p);
            $article->ora_p = date($request->ora_p);
        }
        $article->save();
        if($request->topic=='other'){
            $article->topic()->firstOrCreate(array('name'=>$request->input('o_topic')));
        }else{
            $article->topic()->sync($request->topic);
        }
        $article->users()->sync($request->author);
        return redirect()->route('articles.index');
    }

    public function search (){
        /*$request->get('searchQ');
        $articles= DB::table('articles')->where('articles.title','like','%'.$request->get('searchQ').'%')
        ->leftJoin('articles_topic','articles.id','articles_topic.articles_id',)->get();
        return json_encode($articles);*/
        $users=User::all();
        $topics=Topic::all();
            $articles=Articles::leftJoin('articles_topic', 'articles.id','=','articles_topic.articles_id')
            ->leftJoin('topics','articles_topic.topic_id','topics.id')
            ->leftJoin('articles_user','articles.id','articles_user.articles_id')
            ->leftJoin('users','articles_user.user_id','users.id')
            ->where('t_name','like','%'.$_GET['searchQ'].'%')->orWhere('title','like','%'.$_GET['searchQ'].'%')
            ->orWhere('name','like','%'.$_GET['searchQ'].'%')->get();

        return view('searchArticles')->with('users',$users)->with('articles',$articles);


    }

}
