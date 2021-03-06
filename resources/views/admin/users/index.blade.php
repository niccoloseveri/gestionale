@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Gestione Utenti') }}
                    <a href="{{route('admin.users.create')}}"><button class="btn btn-success float-right">Inserisci Utente</button></a>
                </div>

                <div class="card-body table-responsive">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Cognome</th>
                            <th scope="col">Ruolo</th>
                            <th scope="col">Azioni</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{$user->id}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</td>
                                <td>
                                <a href="{{ route('admin.users.edit',$user->id) }}"> <button type="button" class="btn btn-light float-left" style="margin-right: 0.7rem;">Modifica</button></a>
                                <form action="{{route('admin.users.destroy', $user)}}" method="POST">
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
            </div>
        </div>
    </div>
</div>
@endsection
