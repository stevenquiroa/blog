@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <p>Modulos disponibles:</p>
                    <ul>
                        <li><a href="{{action('PostController@index')}}">Publicaciones</a></li>
                        <li><a href="{{action('CategoryController@index')}}">Categorias</a></li>
                        <li><a href="{{action('MenuController@index')}}">Menus</a></li>
                        <li>Usuarios</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
