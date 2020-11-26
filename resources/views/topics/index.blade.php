@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Gestione Argomenti') }}
                <a href="{{route('topics.create')}}"><button class="btn btn-success float-right">Inserisci Argomento</button></a>
            </div>
                <div class="card-body table-responsive">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Azioni</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($topics as $topic)
                            <tr>
                                <th scope="row">{{$topic->id}}</th>
                                <td><a href="{{route('topics.show',$topic->id)}}">{{$topic->t_name}}</a></td>

                                <td>
                                <a href="{{ route('topics.edit',$topic->id) }}"> <button type="button" class="btn btn-light float-left" style="margin-right: 0.7rem;">Modifica</button></a>
                                <form action="{{route('topics.destroy', $topic)}}" method="POST">
                                    @csrf
                                    {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger float-left" style="margin-right: 0.7rem">Elimina</button>
                                </form>
                                <a href="{{ route('topics.assign',$topic->id)}}"><button type="button" class="btn btn-info float-left">Assegna a utente</button></a>
                                </td>
                                </tr>
                            @endforeach

                        </tbody>
                      </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
