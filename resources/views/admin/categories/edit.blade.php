@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Categoría
                </div>

                <div class="panel-body">
                @if (count($errors) > 0)
                    @include('partials/message-bag')
                @endif
                <form action="{{action('CategoryController@update', ['id' => $category->id])}}" method="POST">
                  {{csrf_field()}}
                  <div class="form-group">
                    <label for="title">Titulo</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Titulo" value="{{$category->title}}">
                  </div>
                  <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" name="slug" maxlength="15" id="slug" placeholder="slug" value="{{$category->slug}}">
                  </div>
                  <div class="form-group">
                    <label for="description">Contenido</label>
                    <textarea class="form-control" name="description" id="description">{{$category->description}}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="status">Estado</label>
                    <select name="status" id="status" class="form-control">
                      <option value="active">Publicado</option>
                      <option value="inactive">Papelera</option>
                    </select>
                  </div>
                  <p>
                    <button type="submit" class="btn btn-default">Actualizar</button>
                  </p>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
@if($category)
document.getElementById('status').value = '{{$category->status}}'
@endif
</script>
@endsection
