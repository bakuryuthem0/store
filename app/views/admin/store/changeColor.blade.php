@extends('admin.layouts.default')

@section('content')
<?php $colors = json_decode(stripslashes($store->color_palet)); ?>
<div class="content-wrapper">
<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="col-xs-12 col-md-6 center-block">
            <div class="box">
              <div class="box-header box-primary with-border">
                <h3 class="box-title">Agregar / Cambiar logo</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="formulario">
                  @if(Session::has('success'))
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('success') }}
                  </div>
                  @endif
                  <form method="POST" action="{{ URL::to('administrador/tienda/editar-colores/enviar') }}" enctype="multipart/form-data" class="form-logo">
                    <div class="formulario bg-warning padding-1">
                      <p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Todos los colores son obligatorios. Para cambiar el color, haga click en el campo, seleccione el color y por ultimo precione el boton <div class="colorpicker_submit text"></div></p>
                    </div>
                    @if(!is_null($store->color_palet))
                      <div class="col-xs-12 col-md-6 formulario">
                        <label>Color de fondo (primario)</label>
                        <input type="text" name="first_background" class="colorPicker form-control" value="{{ $colors->first->background_color }}">
                        @if($errors->has('first_background'))
                            @foreach($errors->get('first_background') as $err)
                              <div class="alert alert-danger formulario"><p class="">{{ $err }}</p></div>
                            @endforeach
                         @endif
                      </div>
                      <div class="col-xs-12 col-md-6 formulario">
                        <label>Color del text (primario)</label>
                        <input type="text" name="first_color" class="colorPicker form-control" value="{{ $colors->first->color }}">
                        @if($errors->has('first_color'))
                            @foreach($errors->get('first_color') as $err)
                              <div class="alert alert-danger formulario"><p class="">{{ $err }}</p></div>
                            @endforeach
                         @endif
                      </div>
                      <div class="col-xs-12 col-md-6 formulario">
                        <label>Color de fondo (secundario)</label>
                        <input type="text" name="second_background" class="colorPicker form-control" value="{{ $colors->second->background_color }}">
                        @if($errors->has('second_background'))
                            @foreach($errors->get('second_background') as $err)
                              <div class="alert alert-danger formulario"><p class="">{{ $err }}</p></div>
                            @endforeach
                         @endif
                      </div>
                      <div class="col-xs-12 col-md-6 formulario">
                        <label>Color del text (secundario)</label>
                        <input type="text" name="second_color" class="colorPicker form-control" value="{{ $colors->second->color }}">
                        @if($errors->has('second_color'))
                            @foreach($errors->get('second_color') as $err)
                              <div class="alert alert-danger formulario"><p class="">{{ $err }}</p></div>
                            @endforeach
                         @endif
                      </div>
                      <div class="col-xs-12 col-md-6 formulario">
                        <label>Color de fondo (terciario)</label>
                        <input type="text" name="third_background" class="colorPicker form-control" value="{{ $colors->third->background_color }}">
                        @if($errors->has('third_background'))
                            @foreach($errors->get('third_background') as $err)
                              <div class="alert alert-danger formulario"><p class="">{{ $err }}</p></div>
                            @endforeach
                         @endif
                      </div>
                      <div class="col-xs-12 col-md-6 formulario">
                        <label>Color del text (terciario)</label>
                        <input type="text" name="third_color" class="colorPicker form-control" value="{{ $colors->third->color }}">
                        @if($errors->has('third_color'))
                            @foreach($errors->get('third_color') as $err)
                              <div class="alert alert-danger formulario"><p class="">{{ $err }}</p></div>
                            @endforeach
                         @endif
                      </div>
                    @else
                    @endif
                    <div class="formulario">
                      
                    </div>
                  </form>
                </div>
              </div><!-- /.box-body -->
              <div class="box-footer">
                <div class="formulario">
                  <button class="btn btn-success btn-send">Enviar</button>
                </div>
              </div><!-- box-footer -->
            </div><!-- /.box -->
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
        
@stop

@section('postscript')
<link rel="stylesheet" media="screen" type="text/css" href="{{ asset('plugins/colorPicker/lib/colorpicker.css') }}" />
<script type="text/javascript" src="{{ asset('plugins/colorPicker/lib/colorpicker.js') }}"></script>

<script type="text/javascript">
  $('.colorPicker').ColorPicker({
    onSubmit: function(hsb, hex, rgb, el) {
      $(el).val('#'+hex);
      $(el).ColorPickerHide();
    },
    onBeforeShow: function () {
      $(this).ColorPickerSetColor(this.value);
    }
  })
  .bind('keyup', function(){
    $(this).ColorPickerSetColor(this.value);
  });
  $('.btn-send').on('click', function(event) {
    if ($('.file').val() != "") {
      $('.form-logo').submit();
    };
  });
</script>
@stop