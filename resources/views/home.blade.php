@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Articoli') }}
                    <a href="{{route('articles.create')}}"><button class="btn btn-success float-right">Inserisci Articolo</button></a>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Titolo</th>
                            <th scope="col">Argomento</th>
                            <th scope="col">Autore</th>
                            <th scope="col">Data pubblicazione</th>
                            <th scope="col">Azioni</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $article)
                            <tr>
                                <th scope="row">{{$article->id}}</th>
                                <td>{{$article->title}}</td>
                                <td>{{implode(',',$article->topic()->get()->pluck('name')->toArray())}}</td>
                            <td>{{implode(',',$article->users()->get()->pluck('name')->toArray())}}</td>
                                <td>{{$article->data_p}} {{$article->ora_p}}</td>
                                <td>
                                <a href="{{ route('articles.edit',$article->id) }}"> <button type="button" class="btn btn-light float-left">Modifica</button></a>
                                <form action="{{route('articles.destroy', $article)}}" method="POST">
                                    @csrf
                                    {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger float-left">Elimina</button>
                                </form>
                                </td>
                                </tr>
                            @endforeach

                        </tbody>
                      </table>

                </div>
                <div class="card-footer text-muted">
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection
