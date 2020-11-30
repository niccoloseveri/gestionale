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
                <div class="card-header">{{ __('Modifica Argomento') }} {{$topic->t_name}}</div>
                <div class="card-body">
                    <form method="POST" action="{{route('topics.update',$topic)}}">
                        <div class="form-group row">
                            <label for="t_name" class="col-md-4 col-form-label text-md-right">Nome</label>
                            <div class="col-md-6">
                                <input id="t_name" type="text" class="form-control @error('t_name') is-invalid @enderror" name="t_name" value="{{ $topic->t_name }}">
                                @error('t_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @csrf
                        {{method_field('PUT')}}
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
