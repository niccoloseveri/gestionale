<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Articles;
use App\Models\User;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
        $topics = Topic::all()->sortBy('t_name');
        return view('topics.index')->with('topics', $topics);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('topics.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            't_name'=> ['required', 'max:255'],
        ]);

        $topic = new Topic;
        $topic->t_name = $request->t_name;
        if($request->author!=''){
            $topic->assigned = 1;
            $topic->user()->sync($request->author);
        }
        $topic->save();
        return redirect()->route('topics.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $articles=Articles::all()->sortByDesc('created_at');
        $actual_topic=Topic::where('id',$id)->get('t_name')->pluck('t_name')->first();
        return view('topics.show')->with('topic_id',$id)->with('articles',$articles)->with('topic_name',$actual_topic);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        $users=User::all();
        return view('topics.edit')->with('topic',$topic)->with('users',$users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topic $topic)
    {
        if($request->input('t_name')!=""){
            $topic->t_name = $request->input('t_name');
        }
        if($request->author!='no'){
            $topic->assigned = 1;
            $topic->user()->sync($request->author);
        }
        $topic->save();
        return redirect()->route('topics.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        $topic->article()->detach();
        $topic->delete();
        return redirect()->route('topics.index');
    }


    public function assign(Topic $topic){
        $users=User::all();
        return view('topics.assign')->with('topic',$topic)->with('users',$users);
    }


    //-------------------------

    public function detach(Topic $topic){
        $topic->user()->detach();
        $topic->assigned = 0;
        $topic->save();
        return redirect()->route('topics.index');
    }

}
