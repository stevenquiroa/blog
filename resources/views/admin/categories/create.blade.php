@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Publicación
                </div>

                <div class="panel-body">
                @if (count($errors) > 0)
                    @include('partials/message-bag')
                @endif
                <form action="{{action('CategoryController@store')}}" method="POST">
                  {{csrf_field()}}
                  <div class="form-group">
                    <label for="title">Titulo</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Titulo" value="{{old('title')}}">
                  </div>
                  <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" name="slug" maxlength="15" id="slug" placeholder="slug" value="{{old('slug')}}">
                  </div>
                  <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea class="form-control" name="description" id="description">{{old('content')}}</textarea>
                  </div>
                  <button type="submit" class="btn btn-default">Crear</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
