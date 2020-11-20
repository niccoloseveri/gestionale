@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><span>{{ __('Articoli') }}</span>
                   <div class="row align-items-end float-right"> <a href="{{route('articles.create')}}"><button class="btn btn-success float-right ">Inserisci Articolo</button></a></div>
                </div>
                <div class="card-header">
                    <form class="form-inline col-md-auto d-flex justify-content-center" method="GET" action="{{route('articles.search')}}"><!--<select class="form-control col-md-2" id="searchFor" name="searchFor">
                        <option value="1" selected>Cerca per titolo:</option>
                        <option value="2">Cerca per topic:</option>
                        </select> -->
                        <input type="text" name="searchQ" id="searcharticles" class="form-control col-md-auto" style="margin:0.1em;"   placeholder="Cerca..."/>
                        <label for="dateFrom"style="margin:0.1em;" class="col-form-label text-md-right">Dal giorno:</label>
                        <input type="date" id="dateFrom" name="dateFrom" style="margin:0.1em;" class="form-control" placeholder="yyyy-mm-dd" value="1970-01-01" />
                        <label for="dateTo" class="col-form-label text-md-right" style="margin:0.1em;">Al giorno:</label>
                        <input type="date" id="dateTo" name="dateTo"  style="margin:0.1em;" class="form-control" placeholder="yyyy-mm-dd" value="{{$today}}" required/>
                        <label for="author" style="margin:0.1em;" class="col-form-label text-md-right">Autore:</label>
                        <select id="author" type="text" style="margin:0.1em;" class="form-control @error('author') is-invalid @enderror" name="author">
                            <option value="">---</option>
                            @foreach ($users as $user)
                                <option value="{{$user->name}}" >{{$user->name}}</option>
                            @endforeach
                        </select>
                        <input type="submit" class=" form-control btn btn-info float-right"  style="margin:0.1em; color:white;" value="Cerca" >
                    </form>
                </div>

                <div class="card-body table-responsive">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Titolo</th>
                            <th scope="col">Argomento</th>
                            <th scope="col">Autore</th>
                            <th scope="col">Data pubblicazione</th>

                           @can('manage-posts')
                           <th scope="col">Prenotato il</th>
                            <th scope="col">Azioni</th>
                           @endcan
                          </tr>
                        </thead>
                        <tbody id="articles-row">
                            @foreach ($articles as $article)
                            <tr>
                                <th scope="row">{{$article->id}}</th>
                                <td>{{$article->title}}</td>
                                <td>{{implode(',',$article->topic()->get()->pluck('t_name')->toArray())}}</td>
                            <td>{{implode(',',$article->users()->get()->pluck('name')->toArray())}}</td>
                                <td>{{$article->data_p->format('d/m/Y')}} {{$article->ora_p->format('H:i:s')}}</td>
                                @can('manage-posts')
                                <td>{{$article->created_at->format('d/m/Y H:i:s')}}</td>
                                <td>
                                <a href="{{ route('articles.edit',$article->id) }}"> <button type="button" class="btn btn-light float-left" style="margin-right: 0.7rem;">Modifica</button></a>
                                <form action="{{route('articles.destroy', $article)}}" method="POST" class="float-left">
                                    @csrf
                                    {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger float-left">Elimina</button>
                                </form>
                                </td>
                                @endcan
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
