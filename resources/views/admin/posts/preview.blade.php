@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Preview de {{$post->title}}
                </div>

                <div class="panel-body">
                    <h2>{{$post->title}}</h2>
                    {{$post->content}}
                    
                    @if(!empty($post->categories))
                    <p>Categorias:</p>
                    <ul>
                        @foreach($post->categories as $c)
                        <li>{{$c->title}}</li>

                        @endforeach
                    </ul>
                    @endif

                    <p>
                        <a class="btn btn-default" href="{{action('PostController@edit', ['id' => $post->id])}}">Editar</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
