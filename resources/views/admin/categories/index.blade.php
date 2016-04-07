@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listado de Categorias <a class="btn btn-default" href="{{action('CategoryController@create')}}">Crear Categoría</a>
                </div>

                <div class="panel-body">
                    <form action="{{action('CategoryController@index')}}" class="form-inline">
                      <div class="form-group">
                        <input type="text" class="form-control" name="title" id="title" placeholder="Titulo" value="{{$inputs['title']}}">
                      </div>
                      <button type="submit" class="btn btn-default">Filtrar</button>
                    </form>
                    @if($categories)
                    <p>
                        <ul>
                            @foreach($categories as $c)
                            <li><a href="{{action('CategoryController@show', ['id' => $c->id])}}">{{$c->title}}</a></li>
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
