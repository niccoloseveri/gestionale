@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header">Modifica Articolo {{$articles->name}}</div>

                <div class="card-body">
                    <form action="{{route('articles.update', $articles)}}" method="POST">
                    @csrf
                    {{method_field('PUT')}}
                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label text-md-right">Titolo</label>
                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}">
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
                            <input id="topic" type="text" class="form-control @error('topic') is-invalid @enderror" name="topic" value="{{ old('topic') }}">
                            @error('topic')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    @can('select-users')
                    <div class="form-group row">
                        <label for="author" class="col-md-4 col-form-label text-md-right">Autore</label>
                        <div class="col-md-6">
                            <select id="author" type="text" class="form-control @error('author') is-invalid @enderror" name="author">
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}" @if($articles->users->pluck('id')->contains($user->id)) selected @endif>{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endcan

                    <div class="form-group row">
                        <label for="data_p" class="col-md-4 col-form-label text-md-right">Data Pubblicazione</label>
                        <div class="col-md-6">
                        <input type="date" name="data_p" class="form-control" value=""/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ora_p" class="col-md-4 col-form-label text-md-right">Ora Pubblicazione</label>
                        <div class="col-md-6">
                            <input type="time" name="ora_p" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group row">

                    <button type="submit" class="btn btn-primary">Invia</button>
                </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
