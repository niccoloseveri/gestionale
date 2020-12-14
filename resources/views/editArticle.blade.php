@extends('layouts.app')

@section('content')
<script type="text/javascript">
    function showOther(that){
        if(that.value=='other'){
            document.getElementById('o_topic').style.visibility = "visible";
        }else document.getElementById('o_topic').style.visibility = "hidden";
    }
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Modifica Articolo') }} {{$articles->title}}
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('articles.update',$articles)}}">

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">Titolo</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $articles->title }}">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="topic" class="col-md-4 col-form-label text-md-right">Argomento</label>
                            <div class="col-md-6">
                                <select id="topic" onchange="showOther(this)" type="text" class="form-control @error('topic') is-invalid @enderror" name="topic">
                                @error('topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @foreach($topics as $topic)
                                @if(implode(',',$topic->user()->get()->pluck('id')->toArray())==Auth::id())
                                <option id="{{$topic->t_name}}" value="{{$topic->id}}" @if (implode(',',$articles->topic()->get()->pluck('t_name')->toArray())==$topic->t_name) selected @endif>{{$topic->t_name}} </option>

                                @endif
                                @endforeach
                                <option disabled>------------</option>
                                @foreach($topics as $topic)
                                @if ($topic->assigned==0)
                                <option id="{{$topic->t_name}}" value="{{$topic->id}}" @if (implode(',',$articles->topic()->get()->pluck('t_name')->toArray())==$topic->t_name) selected @endif>{{$topic->t_name}} </option>
                                @endif
                                @endforeach
                                <option id="other" value="other">Altro</option>
                                </select>
                                <input class="form-control" type="text" id="o_topic" name="o_topic" style=" margin-top:0.5em; visibility: hidden"/>
                            </div>
                        </div>
                        @csrf
                        {{method_field('PUT')}}
                        <div class="form-group row">
                            <label for="author" class="col-md-4 col-form-label text-md-right">Autore</label>
                            <div class="col-md-6 ">
                                <select id="author" type="text" class="form-control @error('author') is-invalid @enderror" name="author" @if(!(Auth::user()->hasRole('admin'))) disabled @endif>

                                    @foreach ($users as $user)
                                        <option value="{{$user->id}}" @if(Auth::id()==$user->id) selected @endif >{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="data_p" class="col-md-4 col-form-label text-md-right">Data Pubblicazione</label>
                            <div class="col-md-6">
                            <input type="date" name="data_p" class="form-control" value="{{date($articles->data_p)}}"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ora_p" class="col-md-4 col-form-label text-md-right">Ora Pubblicazione</label>
                            <div class="col-md-6">
                            <input type="time" name="ora_p" class="form-control" value="{{date($articles->ora_p)}}"/>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Invia') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
