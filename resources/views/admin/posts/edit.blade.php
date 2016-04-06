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
                <form action="{{action('PostController@update', ['id' => $post->id])}}" method="POST">
                  {{csrf_field()}}
                  <div class="form-group">
                    <label for="title">Titulo</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Titulo" value="{{$post->title}}">
                  </div>
                  <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" name="slug" maxlength="15" id="slug" placeholder="slug" value="{{$post->slug}}">
                  </div>
                  <div class="form-group">
                    <label for="content">Contenido</label>
                    <textarea class="form-control" name="content" id="content">{{$post->content}}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="type">Tipo</label>
                    <select name="type" id="type" class="form-control">
                      <option value="post">Entrada</option>
                      <option value="page">Página</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="categories">Categorias</label>
                    <div class="checkbox">

                      @foreach($categories as $c)
                      <label>
                        <input name="categories[]" value="{{$c->id}}"
                        @if(in_array($c->id, $categories_in))
                          checked="" 
                        @endif
                         type="checkbox"> {{$c->title}}
                      </label>
                      @endforeach
                    </div>
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
@if($post)
document.getElementById('type').value = '{{$post->type}}'
document.getElementById('status').value = '{{$post->status}}'
@endif
</script>
@endsection
