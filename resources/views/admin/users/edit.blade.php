@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header">Modifica Utete {{$user->name}}</div>

                <div class="card-body">
                <form action="{{route('admin.users.update', $user)}}" method="POST">
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}"  autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Nome</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}"  autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    @csrf
                    {{method_field('PUT')}}
                    <div class="form-group row">
                        <label for="rules" class="col-md-4 col-form-label text-md-right">Ruolo</label>
                        <div class="col-md-6">
                    @foreach($roles as $role)
                        <div class="form-check">

                        <input type="radio" name="roles[]" value="{{$role->id}}"
                        @if($user->roles->pluck('id')->contains($role->id)) checked @endif>
                        <label>{{$role -> name}}</label>
                        </div>
                    @endforeach
                    </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">
                            <button type="submit" class="btn btn-primary">Invia</button></label>


                    </div>

                </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
