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
                                <a href="{{ route('topics.edit',$topic->id) }}"> <button type="button" class="btn btn-light float-left" style="margin: 0.5rem;">Modifica</button></a>

                                <form action="{{route('topics.destroy', $topic)}}" method="POST">
                                    @csrf
                                    {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger float-left" style="margin: 0.5rem">Elimina</button>
                                </form>
                                @if($topic->assigned==1)
                                <a href="{{ route('topics.detach',$topic->id) }}"> <button type="button" class="btn btn-secondary float-left" style="margin: 0.5rem;">Rendi Pubblico</button></a>
                                @else
                                <a href="{{ route('topics.assign',$topic->id)}}"><button type="button" class="btn btn-secondary float-left" style="margin: 0.5rem;">Assegna a utente</button></a>

                                @endif
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
