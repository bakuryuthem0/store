@extends('admin.layouts.default')

@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li class=""><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a href="#"><i class="fa fa-shopping-bag"></i> Nuevo producto</a></li>
          </ol>
        </section>
        <div class="row">
          <div class="col-xs-12 col-md-10 col-md-offset-1 formulario">
              <div class="box box-success">
                <div class="box-header">
                  <i class="fa fa-comments-o"></i>
                  <h3 class="box-title">Nuevo producto</h3>
                </div>
                <div class="box-body chat" id="chat-box">
                  @if(Session::has('success'))
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('success') }}
                  </div>
                  @endif
                  <form class="new-user-form row" method="POST" action="{{ URL::to('administrador/producto/nuevo/enviar') }}" enctype="multipart/form-data"> 
                     <div class="col-xs-12">
                        <h3>Datos básicos.</h3>
                     </div>
                     <div class="formulario col-xs-12 col-md-6">
                        <div class="input-group">
                           <label class="item-label">Título (español).</label>
                           <label class="control-label label-control-success hidden"><i class="fa fa-check"></i> <p class="success-text"></p></label>
                           <label class="control-label label-control-danger hidden"><i class="fa fa-times-circle"></i> <p class="danger-text"></p></label>
                           <input type="text" class="form-control" name="title_es" placeholder="Título" value="{{ Input::old('title_es') }}" required>
                           @if($errors->has('title_es'))
                              @foreach($errors->get('title_es') as $err)
                              <div class="clearfix"></div>
                              <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ $err }}
                              </div>
                              @endforeach
                            @endif
                        </div>
                     </div>
                     <div class="formulario col-xs-12 col-md-6">
                        <div class="input-group">
                           <label class="item-label">Título (ingles).</label>
                           <label class="control-label label-control-success hidden"><i class="fa fa-check"></i> <p class="success-text"></p></label>
                           <label class="control-label label-control-danger hidden"><i class="fa fa-times-circle"></i> <p class="danger-text"></p></label>
                           <input type="text" class="form-control" name="title_eng" placeholder="Título" value="{{ Input::old('title_eng') }}" required>
                           @if($errors->has('title_eng'))
                              @foreach($errors->get('title_eng') as $err)
                              <div class="clearfix"></div>
                              <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ $err }}
                              </div>
                              @endforeach
                            @endif
                        </div>
                     </div>
                     <div class="formulario col-xs-12 col-md-6">
                        <div class="input-group">
                           <label class="item-label">Categoría.</label>
                           <label class="control-label label-control-success hidden"><i class="fa fa-check"></i> <p class="success-text"></p></label>
                           <label class="control-label label-control-danger hidden"><i class="fa fa-times-circle"></i> <p class="danger-text"></p></label>
                           <select class="form-control category" name="category">
                              <option value="">Seleccione una opción</option>
                              @foreach($cat as $c)
                                 <option value="{{ $c->id }}">{{ $c->description_es }}</option>
                              @endforeach
                           </select>
                           @if($errors->has('category'))
                              @foreach($errors->get('category') as $err)
                              <div class="clearfix"></div>
                              <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ $err }}
                              </div>
                           @endforeach
                         @endif
                        </div>
                     </div>
                     <div class="formulario col-xs-12 col-md-6">
                        <div class="input-group">
                           <label class="item-label">Sub-categoría</label>
                           <label class="control-label label-control-success hidden"><i class="fa fa-check"></i> <p class="success-text"></p></label>
                           <label class="control-label label-control-danger hidden"><i class="fa fa-times-circle"></i> <p class="danger-text"></p></label>
                           <div class="input-group">
                              <select class="form-control subCategory" name="sub-category">
                                 <option value="">Seleccione una opción</option>
                              </select>
                              <span class="input-group-btn btnLoader">
                                 <button class="btn btn-default" type="button">
                                    <img src="{{ asset('images/loader.gif') }}" class="miniLoader">
                                    <i class="fa fa-close danger-text"></i>
                                    <i class="fa fa-check success-text hidden"></i>
                                 </button>
                              </span>
                           </div>
                        </div>
                        @if($errors->has('sub-category'))
                           @foreach($errors->get('sub-category') as $err)
                           <div class="clearfix"></div>
                           <div class="alert alert-danger">
                             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                             {{ $err }}
                           </div>
                           @endforeach
                         @endif
                     </div>
                     <div class="formulario col-xs-12 col-md-6">
                        <div class="input-group">
                           <label class="item-label">Precio</label>
                           <label class="control-label label-control-success hidden"><i class="fa fa-check"></i> <p class="success-text"></p></label>
                           <label class="control-label label-control-danger hidden"><i class="fa fa-times-circle"></i> <p class="danger-text"></p></label>
                           <input type="text" class="form-control" name="price" placeholder="Precio" value="{{ Input::old('price') }}" required>
                           @if($errors->has('price'))
                              @foreach($errors->get('price') as $err)
                              <div class="clearfix"></div>
                              <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ $err }}
                              </div>
                              @endforeach
                            @endif
                        </div>
                     </div>
                     <div class="formulario col-xs-12 col-md-6">
                        <div class="input-group">
                           <label class="item-label">Stock</label>
                           <label class="control-label label-control-success hidden"><i class="fa fa-check"></i> <p class="success-text"></p></label>
                           <label class="control-label label-control-danger hidden"><i class="fa fa-times-circle"></i> <p class="danger-text"></p></label>
                           <input type="text" class="form-control" name="stock" placeholder="Stock" value="{{ Input::old('stock') }}" required>
                           @if($errors->has('stock'))
                              @foreach($errors->get('stock') as $err)
                              <div class="clearfix"></div>
                              <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ $err }}
                              </div>
                              @endforeach
                            @endif
                        </div>
                     </div>
                     <div class="col-xs-12">
                        <h3>Detalles del producto.</h3>
                     </div>
                     @if($store->store_type == 1)
                      {{ View::make('admin.partials.type1') }}
                     @elseif($store->store_type == 2)
                      {{ View::make('admin.partials.type2') }}
                     @endif
                     <div class="col-xs-12">
                        <h3>Descripción / Imagenes.</h3>
                     </div>
                     <div class="col-xs-12 formulario">
                        (Español)
                        <textarea id="editor1" name="description_es" rows="10" cols="80">
                           {{Input::old('description_es') }}
                        </textarea>
                        @if($errors->has('description_es'))
                           @foreach($errors->get('description_es') as $err)
                           <div class="clearfix"></div>
                           <div class="alert alert-danger">
                             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                             {{ $err }}
                           </div>
                           @endforeach
                        @endif
                     </div>
                     <div class="col-xs-12 formulario">
                        (Ingles)
                        <textarea id="editor2" name="description_eng" rows="10" cols="80">
                           {{Input::old('description_eng') }}
                        </textarea>
                        @if($errors->has('description_eng'))
                           @foreach($errors->get('description_eng') as $err)
                           <div class="clearfix"></div>
                           <div class="alert alert-danger">
                             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                             {{ $err }}
                           </div>
                           @endforeach
                        @endif
                     </div>
                     <div class="col-xs-12 col-md-6 formulario">
                        <div class="input-group">
                           <label class="item-label">Imagen principal</label>
                           <input type="file" name="img[]">
                           @if($errors->has('img'))
                              @foreach($errors->get('img') as $err)
                              <div class="clearfix"></div>
                              <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ $err }}
                              </div>
                              @endforeach
                           @endif
                        </div>
                     </div>
                     <div class="col-xs-12 col-md-6 new-image to-clone formulario">
                        <button type="button" class="close dimiss-cloned">&times;</button>
                        <br>
                        <div>
                          <input type="file" name="" class="file_es">
                        </div>
                     </div>
                     <div class="col-xs-12 formulario">
                        <button type="button" class="btn btn-primary btn-clone" data-target="new-image" data-input="file_" data-name-es="img[]" data-name-eng="img[]">
                          Agregar Imagen
                        </button>                     
                     </div>
                     <div class="col-xs-12 formulario">
                        Agregar Tags(Español <small><strong>Escriba su Etiqueta y presione enter</strong></small>) 
                        <br>
                        <select name="tag_es[]" multiple data-role="tagsinput"/>
                        </select>
                     </div>
                     <div class="col-xs-12 formulario">
                        Agregar Tags(Ingles)
                        <br>
                        <select name="tag_eng[]" multiple data-role="tagsinput"/>
                        </select>
                     </div>
                  </form>
                </div><!-- /.chat -->
                <div class="box-footer">
                  <div class="col-xs-12">
                     <button class="btn btn-success btn-new-user">Enviar</button>
                  </div>
                </div>
              </div><!-- /.box (chat box) -->

          </div>
        </div>

      </div><!-- /.content-wrapper -->
        
@stop

@section('postscript')
{{ HTML::script('admin/plugins/ckeditor/ckeditor.js') }}
{{ HTML::style('admin/plugins/bootstrap-tags/bootstrap-tags/dist/bootstrap-tagsinput.css') }}
{{ HTML::script('admin/plugins/bootstrap-tags/bootstrap-tags/dist/bootstrap-tagsinput.min.js') }}


<!-- CK Editor -->
 <script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
 <script>
   $(function () {
     // Replace the <textarea id="editor1"> with a CKEditor
     // instance, using default configuration.
     CKEDITOR.replace('editor1');
     CKEDITOR.replace('editor2');
     //bootstrap WYSIHTML5 - text editor
   });
 </script>
@stop