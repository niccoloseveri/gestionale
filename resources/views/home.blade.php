@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-13">
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

                            <th scope="col">Titolo</th>
                            <th scope="col">Argomento</th>
                            <th scope="col" style="text-align: center">Autore</th>
                            <th scope="col" style="text-align: center">Data pubblicazione</th>
                            <th scope="col">Pubblicato</th>
                           @can('manage-posts')
                           <th scope="col" style="text-align: center">Prenotato il</th>
                            <th scope="col" style="text-align: center">Azioni</th>
                           @endcan
                          </tr>
                        </thead>
                        <tbody id="articles-row">
                            @foreach ($articles as $article)
                            <tr>

                                <td>{{$article->title}}</td>
                                <td>{{implode(',',$article->topic()->get()->pluck('t_name')->toArray())}}</td>
                            <td style="text-align: center">{{implode(',',$article->users()->get()->pluck('name')->toArray())}}</td>
                                <td style="text-align: center">{{$article->data_p->format('d/m/Y')}} {{$article->ora_p->format('H:i:s')}}</td>
                                @if ($article->published == 1)
                                <td style="text-align: center">
                                    <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-check-square-fill" fill="lightgreen" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm10.03 4.97a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                      </svg>
                                </td>
                                @else
                                <td style="text-align: center">
                                    <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-exclamation-square-fill" fill="red" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                      </svg>
                                  </td>
                                @endif
                                @can('manage-posts')
                                <td style="text-align: center">{{$article->created_at->format('d/m/Y H:i:s')}}</td>
                                <td style="text-align: center">
                                <a href="{{ route('articles.edit',$article->id) }}"> <button type="button" class="btn btn-light float-left" style="margin: 0.5rem;">Modifica</button></a>
                                <form action="{{route('articles.destroy', $article)}}" method="POST" style="margin:0.5rem" class="float-left">
                                    @csrf
                                    {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger float-left" >Elimina</button>
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
