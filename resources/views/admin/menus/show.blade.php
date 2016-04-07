@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Preview de {{$menu->title}}
                </div>

                <div class="panel-body">
                    <h2>{{$menu->title}}</h2>
                    <p>
                        <a class="btn btn-default" href="{{action('MenuController@edit', ['id' => $menu->id])}}">Editar</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
