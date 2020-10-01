@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Nuovo Articolo') }}
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('articles.store')}}">
                        @csrf
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

                        <div class="form-group row">
                            <label for="author" class="col-md-4 col-form-label text-md-right">Autore</label>
                            <div class="col-md-6">
                                <select id="author" type="text" class="form-control @error('author') is-invalid @enderror" name="author" @if(!(Auth::user()->hasRole('admin'))) disabled @endif>

                                    @foreach ($users as $user)
                                        <option value="{{$user->id}}" @if(Auth::id()==$user->id) selected @endif @if(!(Auth::user()->hasRole('admin'))) disabled @endif) >{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="data_p" class="col-md-4 col-form-label text-md-right">Data Pubblicazione</label>
                            <div class="col-md-6">
                                <input type="date" name="data_p" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ora_p" class="col-md-4 col-form-label text-md-right">Ora Pubblicazione</label>
                            <div class="col-md-6">
                                <input type="time" name="ora_p" class="form-control"/>
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
