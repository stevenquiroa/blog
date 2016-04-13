@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Menu
                </div>

                <div class="panel-body">
                @if (count($errors) > 0)
                    @include('partials/message-bag')
                @endif
                <form id="submit_menu_form" action="{{action('MenuController@store')}}" method="POST">
                  {{csrf_field()}}
                  <div class="form-group">
                    <label for="title">Titulo</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Titulo" value="{{old('title')}}">
                  </div>
                  <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" name="slug" maxlength="15" id="slug" placeholder="slug" value="{{old('slug')}}">
                  </div>
                  <input type="hidden" id="tabs_menu" name="tabs_menu" value=""/>
                  <p>
                    <button type="submit" class="btn btn-default">Submit</button>                    
                  </p>
                </form>
                  <div class="row">
                    <div class="col-md-5">
                      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                          <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                              <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Entradas
                              </a>
                            </h4>
                          </div>
                          <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                              <form class="form-inline" method="GET" action="{{action('PostController@search')}}" data-type="post" id="post_get_form">
                                <div class="form-group row">
                                  <div class="col-md-9">
                                    <input type="text" class="form-control" name="title" id="post_title" placeholder="Titulo de Entrada">
                                  </div>                              
                                  <div class="col-md-3">
                                    <input type="hidden" name="_token" id="post_token" value="{{csrf_token()}}">
                                    <button type="submit" class="btn btn-default">Buscar</button>
                                  </div>  
                                </div>
                              </form>
                              <div class="row">
                                <div class="col-md-12">
                                  <form id="add-post">
                                    <ul id="post-results" class="list-unstyled categorychecklist"></ul>
                                    <input type="submit" class="btn btn-default" name="submit" disabled="" value="Agregar al menu">                                
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="panel panel-default">
                          <div class="panel-heading" role="tab" id="headingTwo">
                            <h4 class="panel-title">
                              <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Paginas
                              </a>
                            </h4>
                          </div>
                          <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="panel-body">
                              <form class="form-inline" method="GET" action="{{action('PostController@search')}}" data-type="page" id="page_get_form">
                                <div class="form-group row">
                                  <div class="col-md-9">
                                    <input type="text" class="form-control" name="title" id="page_title" placeholder="Titulo de Página">
                                  </div>                              
                                  <div class="col-md-3">
                                    <input type="hidden" name="_token" id="page_token" value="{{csrf_token()}}">
                                    <button type="submit" class="btn btn-default">Buscar</button>
                                  </div>  
                                </div>
                              </form>
                              <div class="row">
                                <div class="col-md-12">
                                  <form id="add-page">
                                    <ul id="page-results" class="list-unstyled categorychecklist"></ul>
                                    <input type="submit" class="btn btn-default" name="submit" disabled="" value="Agregar al menu">                                
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="panel panel-default">
                          <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                              <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Categorias
                              </a>
                            </h4>
                          </div>
                          <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                            <div class="panel-body">
                              <form class="form-inline" method="GET" action="{{action('PostController@search')}}" data-type="category" id="category_get_form">
                                <div class="form-group row">
                                  <div class="col-md-9">
                                    <input type="text" class="form-control" name="title" id="category_title" placeholder="Titulo de Categoría">
                                  </div>                              
                                  <div class="col-md-3">
                                    <input type="hidden" name="_token" id="category_token" value="{{csrf_token()}}">
                                    <button type="submit" class="btn btn-default">Buscar</button>
                                  </div>  
                                </div>
                              </form>
                              <div class="row">
                                <div class="col-md-12">
                                  <form id="add-category">
                                    <ul id="category-results" class="list-unstyled categorychecklist"></ul>
                                    <input type="submit" class="btn btn-default" name="submit" disabled="" value="Agregar al menu">                                
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="panel panel-default">
                          <div class="panel-heading" role="tab" id="headingFour">
                            <h4 class="panel-title">
                              <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Enlaces
                              </a>
                            </h4>
                          </div>
                          <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                            <div class="panel-body">
                              <form method="GET" action="" data-type="link" id="add-link">
                                <div class="form-group">
                                  <input type="text" class="form-control" name="title" id="link_title" placeholder="Titulo">
                                </div>                              
                                <div class="form-group">
                                  <input type="text" class="form-control" name="url" id="link_url" placeholder="Url">
                                </div>
                                <div class="form-group">
                                  <input type="submit" class="btn btn-default" name="submit" value="Agregar al menu">                                
                                </div>                              
                              </form>                                
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-default"  id="deleteZone">
                        <div class="panel-heading" role="tab">
                          <h4 class="panel-title">
                            Zona de Eliminación                            
                          </h4>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <ul id="sortable" class="connectedSortable"></ul>
                    </div>
                  </div>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript" src="{{asset('js/admin/menu.js')}}"></script>
<script>

</script>
@endsection