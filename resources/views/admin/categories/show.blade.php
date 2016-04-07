@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Preview de {{$category->title}}
                </div>

                <div class="panel-body">
                    <h2>{{$category->title}}</h2>
                    {{$category->description}}
                    <br>
                    <p>
                        <a class="btn btn-default" href="{{action('CategoryController@edit', ['id' => $category->id])}}">Editar</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
