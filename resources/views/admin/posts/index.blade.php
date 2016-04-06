@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listado de Publicaciones <a class="btn btn-default" href="{{action('PostController@create')}}">Crear Publicación</a>
                </div>

                <div class="panel-body">
                    <form action="{{action('PostController@index')}}" class="form-inline">
                      <div class="form-group">
                        <select name="type" id="type" class="form-control">
                          <option value="">Todos los tipos</option>
                          <option value="post">Entrada</option>
                          <option value="page">Página</option>
                        </select>
                      </div>
                      
                      <div class="form-group">
                        <input type="text" class="form-control" name="title" id="title" placeholder="Titulo" value="{{$inputs['title']}}">
                      </div>
                      <button type="submit" class="btn btn-default">Filtrar</button>
                    </form>
                    @if($posts)
                    <p>
                        <ul>
                            @foreach($posts as $p)
                            <li><a href="{{action('PostController@preview', ['id' => $p->id])}}">{{$p->title}}</a></li>
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
<script>
@if (isset($inputs['type']))
document.getElementById('type').value = "{{$inputs['type']}}"
@endif
@if (isset($inputs['status']))
document.getElementById('status').value = "{{$inputs['status']}}"
@endif
@if (isset($inputs['role']))
document.getElementById('role').value = "{{$inputs['role']}}"
@endif
@if (isset($inputs['institution']))
document.getElementById('institution').value = {{$inputs['institution']}}
@endif
</script>
@endsection
