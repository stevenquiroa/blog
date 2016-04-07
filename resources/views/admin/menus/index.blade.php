@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listado de Menus <a class="btn btn-default" href="{{action('MenuController@create')}}">Crear Menu</a>
                </div>

                <div class="panel-body">
                    <form action="{{action('MenuController@index')}}" class="form-inline">
                      <div class="form-group">
                        <input type="text" class="form-control" name="title" id="title" placeholder="Titulo" value="{{$inputs['title']}}">
                      </div>
                      <button type="submit" class="btn btn-default">Filtrar</button>
                    </form>
                    @if($menus)
                    <p>
                        <ul>
                            @foreach($menus as $m)
                            <li><a href="{{action('MenuController@show', ['id' => $m->id])}}">{{$m->title}}</a></li>
                            @endforeach
                        </ul>
                    </p>
                    @endif
                    <p>
                        @if($previous)
                        <a href="{{$previous}}">Anterior</a> 
                        @endif
                        @if($next)
                        <a href="{{$next}}">Siguiente</a>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
