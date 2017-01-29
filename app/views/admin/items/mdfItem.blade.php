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
                  <form class="new-user-form row" method="POST" action="{{ URL::to('administrador/productos/modificar/enviar/'.$item->id) }}" enctype="multipart/form-data"> 
                     <div class="col-xs-12">
                        <h3>Datos básicos.</h3>
                     </div>
                     <div class="formulario col-xs-12 col-md-6">
                        <div class="input-group">
                           <label class="item-label">Título (español).</label>
                           <label class="control-label label-control-success hidden"><i class="fa fa-check"></i> <p class="success-text"></p></label>
                           <label class="control-label label-control-danger hidden"><i class="fa fa-times-circle"></i> <p class="danger-text"></p></label>
                           <input type="text" class="form-control" name="title_es" placeholder="Título" value="{{ $item->title_es }}" required>
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
                           <input type="text" class="form-control" name="title_eng" placeholder="Título" value="{{ $item->title_eng }}" required>
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
                                 <option value="{{ $c->id }}" @if($item->cat_id == $c->id) selected @endif>{{ $c->description_es }}</option>
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
                                 @foreach($subcat as $sc)
                                  <option value="{{ $sc->id }}" @if($item->sub_cat_id == $sc->id) selected @endif>{{ $sc->description_es }}</option>
                                 @endforeach
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
                           <input type="text" class="form-control" name="price" placeholder="Precio" value="{{ $item->price }}" required>
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
                           <input type="text" class="form-control" name="stock" placeholder="Stock" value="{{ $item->stock }}" required>
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
                     <div class="col-xs-12 col-md-6 formulario">
                        <div class="input-group">
                           <label class="item-label">Talla (español)</label>
                           <label class="control-label label-control-success hidden"><i class="fa fa-check"></i> <p class="success-text"></p></label>
                           <label class="control-label label-control-danger hidden"><i class="fa fa-times-circle"></i> <p class="danger-text"></p></label>
                           <input type="text" class="form-control" name="size_es[{{ $item->tallas[0]->id }}]" placeholder="Talla (español)" value="{{ $item->tallas[0]->description_es }}" required>
                           @if($errors->has('size_es'))
                              @foreach($errors->get('size_es') as $err)
                              <div class="clearfix"></div>
                              <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ $err }}
                              </div>
                              @endforeach
                            @endif
                        </div>
                     </div>
                     <div class="col-xs-12 col-md-6 formulario">
                        <div class="input-group">
                           <label class="item-label">Talla (ingles)</label>
                           <label class="control-label label-control-success hidden"><i class="fa fa-check"></i> <p class="success-text"></p></label>
                           <label class="control-label label-control-danger hidden"><i class="fa fa-times-circle"></i> <p class="danger-text"></p></label>
                           <input type="text" class="form-control" name="size_eng[{{ $item->tallas[0]->id }}]" placeholder="Talla (ingles)" value="{{ $item->tallas[0]->description_eng }}" required>
                           @if($errors->has('size_eng'))
                              @foreach($errors->get('size_eng') as $err)
                              <div class="clearfix"></div>
                              <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ $err }}
                              </div>
                              @endforeach
                            @endif
                        </div>
                     </div>
                     @if(count($item->tallas) > 1)
                       @for($i = 1; $i < count($item->tallas); $i++)
                          <div class="col-xs-12 no-padding to-clone active">
                            <div>
                              <button type="button" class="close btn-elim-thing" data-id="{{ $item->tallas[$i]->id }}" data-toggle="modal" data-target="#elimItems" data-url="{{ URL::to('administrador/productos/modificar/eliminar-talla') }}" data-what-to-elim="talla">&times;</button>
                            </div>
                            <div class="col-xs-12 col-md-6 formulario">
                               <input type="text" class="form-control" name="size_es[{{ $item->tallas[$i]->id }}]" placeholder="Talla (español)" value="{{ $item->tallas[$i]->description_es }}" required>
                            </div>
                            <div class="col-xs-12 col-md-6 formulario">
                               <input type="text" class="form-control" name="size_eng[{{ $item->tallas[$i]->id }}]" placeholder="Talla (ingles)" value="{{ $item->tallas[$i]->description_eng }}" required>
                            </div>
                          </div>
                        @endfor
                      @endif
                      <div class="col-xs-12 no-padding new-size to-clone">
                         <button type="button" class="close dimiss-cloned">&times;</button>
                         <div class="col-xs-12 col-md-6 formulario">
                            <input type="text" class="form-control size_es" name="" placeholder="Talla (español)" value="" required>
                         </div>
                         <div class="col-xs-12 col-md-6 formulario">
                            <input type="text" class="form-control size_eng" name="" placeholder="Talla (ingles)" value="" required>
                         </div>
                      </div>
                     <div class="col-xs-12 formulario">
                        <button type="button" class="btn btn-primary btn-clone" data-target="new-size" data-input="size_" data-name-es="size_es[]" data-name-eng="size_eng[]">
                          Agregar Talla
                        </button>
                     </div>
                     <div class="col-xs-12 col-md-6 formulario">
                        <div class="input-group">
                           <label class="item-label">Colores (español)</label>
                           <label class="control-label label-control-success hidden"><i class="fa fa-check"></i> <p class="success-text"></p></label>
                           <label class="control-label label-control-danger hidden"><i class="fa fa-times-circle"></i> <p class="danger-text"></p></label>
                           <input type="text" class="form-control" name="color_es[{{ $item->colores[0]->id }}]" placeholder="Color (español)" value="{{ $item->colores[0]->description_es }}" required>
                           @if($errors->has('color_es'))
                              @foreach($errors->get('color_es') as $err)
                              <div class="clearfix"></div>
                              <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ $err }}
                              </div>
                              @endforeach
                           @endif
                        </div>
                     </div>
                     <div class="col-xs-12 col-md-6 formulario">
                        <div class="input-group">
                           <label class="item-label">Colores (ingles)</label>
                           <label class="control-label label-control-success hidden"><i class="fa fa-check"></i> <p class="success-text"></p></label>
                           <label class="control-label label-control-danger hidden"><i class="fa fa-times-circle"></i> <p class="danger-text"></p></label>
                           <input type="text" class="form-control" name="color_eng[{{ $item->colores[0]->id }}]" placeholder="Color (ingles)" value="{{ $item->colores[0]->description_eng  }}" required>
                           @if($errors->has('color_eng'))
                              @foreach($errors->get('color_eng') as $err)
                              <div class="clearfix"></div>
                              <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ $err }}
                              </div>
                              @endforeach
                           @endif
                        </div>
                     </div>
                     @if(count($item->colores) > 1)
                        @for($i = 1; $i < count($item->colores); $i++)
                           <div class="col-xs-12 no-padding to-clone active">
                            <div>
                              <button type="button" class="close btn-elim-thing" data-id="{{ $item->colores[$i]->id }}" data-toggle="modal" data-target="#elimItems" data-url="{{ URL::to('administrador/productos/modificar/eliminar-color') }}" data-what-to-elim="color">&times;</button>
                            </div>
                            <div class="col-xs-12 col-md-6 formulario">
                               <input type="text" class="form-control" name="color_es[{{ $item->colores[$i]->id }}]" placeholder="Color (español)" value="{{ $item->colores[$i]->description_es }}" required>
                            </div>
                            <div class="col-xs-12 col-md-6 formulario">
                               <input type="text" class="form-control" name="color_eng[{{ $item->colores[$i]->id }}]" placeholder="Color (ingles)" value="{{ $item->colores[$i]->description_eng }}" required>
                            </div>
                           </div>
                        @endfor
                     @endif
                     <div class="col-xs-12 no-padding new-color to-clone">
                         <button type="button" class="close dimiss-cloned">&times;</button>
                         <div class="col-xs-12 col-md-6 formulario">
                            <input type="text" class="form-control color_es" placeholder="Color (español)" value="" required>
                         </div>
                         <div class="col-xs-12 col-md-6 formulario">
                            <input type="text" class="form-control color_eng" placeholder="Color (ingles)" value="" required>
                         </div>
                     </div>
                     <div class="col-xs-12 formulario">
                        <button type="button" class="btn btn-primary btn-clone" data-target="new-color" data-input="color_" data-name-es="color_es[]" data-name-eng="color_eng[]">
                          Agregar Color
                        </button>
                     </div>
                     <div class="col-xs-12 col-md-6 formulario">
                        <div class="input-group">
                           <label class="item-label">Material (español)</label>
                           <label class="control-label label-control-success hidden"><i class="fa fa-check"></i> <p class="success-text"></p></label>
                           <label class="control-label label-control-danger hidden"><i class="fa fa-times-circle"></i> <p class="danger-text"></p></label>
                           <input type="text" class="form-control" name="fabric_es[{{ $item->materiales[0]->id }}]" placeholder="Material (español)" value="{{ $item->materiales[0]->description_es }}" required>
                           @if($errors->has('fabric_es'))
                              @foreach($errors->get('fabric_es') as $err)
                              <div class="clearfix"></div>
                              <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ $err }}
                              </div>
                              @endforeach
                           @endif
                        </div>
                     </div>
                     <div class="col-xs-12 col-md-6 formulario">
                        <div class="input-group">
                           <label class="item-label">Material (ingles)</label>
                           <label class="control-label label-control-success hidden"><i class="fa fa-check"></i> <p class="success-text"></p></label>
                           <label class="control-label label-control-danger hidden"><i class="fa fa-times-circle"></i> <p class="danger-text"></p></label>
                           <input type="text" class="form-control" name="fabric_eng[{{ $item->materiales[0]->id }}]" placeholder="Material (ingles)" value="{{ $item->materiales[0]->description_eng }}" required>
                           @if($errors->has('fabric_eng'))
                              @foreach($errors->get('fabric_eng') as $err)
                              <div class="clearfix"></div>
                              <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ $err }}
                              </div>
                              @endforeach
                           @endif
                        </div>
                     </div>
                     @if(count($item->materiales) > 1)
                        @for($i = 1; $i < count($item->materiales); $i++)
                           <div class="col-xs-12 no-padding to-clone active">
                            <div>
                              <button type="button" class="close btn-elim-thing" data-id="{{ $item->colores[$i]->id }}" data-toggle="modal" data-target="#elimItems" data-url="{{ URL::to('administrador/productos/modificar/eliminar-color') }}" data-what-to-elim="color">&times;</button>
                            </div>
                            <div class="col-xs-12 col-md-6 formulario">
                               <input type="text" class="form-control" name="fabric_es[{{ $item->materiales[$i]->id }}]" placeholder="Material (español)" value="{{ $item->materiales[$i]->description_es }}" required>
                            </div>
                            <div class="col-xs-12 col-md-6 formulario">
                               <input type="text" class="form-control" name="fabric_eng[{{ $item->materiales[$i]->id }}]" placeholder="Material (ingles)" value="{{ $item->materiales[$i]->description_eng }}" required>
                            </div>
                           </div>
                        @endfor
                     @endif
                      <div class="col-xs-12 no-padding new-fabric to-clone">
                         <button type="button" class="close dimiss-cloned">&times;</button>
                         <div class="col-xs-12 col-md-6 formulario">
                            <input type="text" class="form-control fabric_es" placeholder="Material (español)" value="" required>
                         </div>
                         <div class="col-xs-12 col-md-6 formulario">
                            <input type="text" class="form-control fabric_eng" placeholder="Material (ingles)" value="" required>
                         </div>
                      </div>
                     <div class="col-xs-12 formulario">
                        <button type="button" class="btn btn-primary btn-clone" data-target="new-fabric" data-input="fabric_" data-name-es="fabric_es[]" data-name-eng="fabric_eng[]">
                          Agregar Material
                        </button>                     
                     </div>
                     @endif
                     <div class="col-xs-12">
                        <h3>Descripción / Imagenes.</h3>
                     </div>
                     <div class="col-xs-12 formulario">
                        (Español)
                        <textarea id="editor1" name="description_es" rows="10" cols="80">
                           {{ $item->description_es }}
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
                           {{ $item->description_eng }}
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
                           <input type="file" name="img[{{ $item->imagenes[0]->id }}]">
                           <img src="{{ asset('images/items/'.$item->imagenes[0]->image) }}" class="img-responsive center-block img-item">
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
                     @if(count($item->imagenes) > 1)
                      @for($i = 1; $i < count($item->imagenes);$i++)
                        <div class="col-xs-12 col-md-6 to-clone active formulario">
                          <div>
                            <button type="button" class="close btn-elim-thing" data-id="{{ $item->imagenes[$i]->id }}" data-toggle="modal" data-target="#elimItems" data-url="{{ URL::to('administrador/productos/modificar/eliminar-imagen') }}" data-what-to-elim="imagen">&times;</button>
                          </div>
                          <br>
                          <div class="input-group">
                            <input type="file" name="img[{{ $item->imagenes[$i]->id }}]" class="file_es">
                            <img src="{{ asset('images/items/'.$item->imagenes[$i]->image) }}" class="img-responsive center-block img-item">
                          </div>
                       </div>
                      @endfor
                     @endif
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
                        @foreach($item->tags as $t)
                          @if(strpos($t->tag_name, '.es') !== false)
                            <option value="{{ str_replace('.es', '', $t->tag_name) }}">{{ str_replace('.es', '', $t->tag_name) }}</option>
                          @endif
                        @endforeach
                        </select>
                     </div>
                     <div class="col-xs-12 formulario">
                        Agregar Tags(Ingles)
                        <br>
                        <select name="tag_eng[]" multiple data-role="tagsinput"/>
                        @foreach($item->tags as $t)
                          @if(strpos($t->tag_name, '.eng') !== false)
                            <option value="{{ str_replace('.eng', '', $t->tag_name) }}">{{ str_replace('.eng', '', $t->tag_name) }}</option>
                          @endif
                        @endforeach
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
      <div class="modal fade" id="elimItems">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Eliminar <span class="what-to-elim"></span></h4>
            </div>
            <div class="modal-body">
              ¿Seguro desea realizar esta acción?, los cambios son irreversibles.
              <div class="alert responseAjax">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p></p>
              </div>
            </div>
            <div class="modal-footer">
              <img src="{{ asset('images/loader.gif') }}" class="miniLoader">
              <button type="button" class="btn btn-danger btn-elim-thing-modal">Eliminar</button>
            </div>
          </div>
        </div>
</div>      
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