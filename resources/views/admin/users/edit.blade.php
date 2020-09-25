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
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    @csrf
                    {{method_field('PUT')}}
                    @foreach($roles as $role)
                        <div class="form-check">
                        <input type="checkbox" name="roles[]" value="{{$role->id}}"
                        @if($user->roles->pluck('id')->contains($role->id)) checked @endif>
                        <label>{{$role -> name}}</label>
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary">Invia</button>
                </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
