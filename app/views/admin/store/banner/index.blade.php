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
            <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="col-xs-12 col-md-6 center-block">
            <div class="box">
              <div class="box-header box-primary with-border">
                <h3 class="box-title">Nuevo / Editar Banner</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="formulario">
                  @if(Session::has('success'))
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('success') }}
                  </div>
                  @endif
                  <form method="POST" action="{{ URL::to('administrador/tienda/banner/enviar') }}" enctype="multipart/form-data" class="form-logo">
                    @if(empty($store->store_banner))
                    <div class="formulario">
                      <a href="#!"><img src="{{ asset('template/'.$store->template.'/images/banner/default.jpg') }}" class="img-responsive fancybox"></a>
                    </div>
                    @else
                    <div class="formulario">
                      <a href="#!"><img src="{{ asset('template/'.$store->template.'/images/banner/'.$store->store_banner) }}" class="img-responsive fancybox"></a>
                    </div>
                    @endif
                    <div class="formulario bg-warning">
                      <p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Se recomienda que la resolución de la imagen sea no menor a 1024px de alto y un peso maximo de 3Mb</p>
                    </div>
                    <div class="formulario">
                      <input type="file" class="file" name="file">
                      @if($errors->has('file'))
                        @foreach($errors->get('file') as $err)
                        <div class="clearfix"></div>
                        <div class="alert alert-danger">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          {{ $err }}
                        </div>
                        @endforeach
                      @endif
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
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/fancybox/source/jquery.fancybox.css?v=2.1.5') }}" media="screen" />

<link rel="stylesheet" type="text/css" href="{{ asset('plugins/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5') }}" />

<link rel="stylesheet" type="text/css" href="{{ asset('plugins/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7') }}" />

<script type="text/javascript" src="{{ asset('plugins/fancybox/source/jquery.fancybox.js?v=2.1.5') }}"></script>


<script type="text/javascript" src="{{ asset('plugins/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5') }}"></script>

<script type="text/javascript" src="{{ asset('plugins/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7') }}"></script>

<script type="text/javascript" src="{{ asset('plugins/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6') }}"></script>

<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('.btn-send').on('click', function(event) {
      if ($('.file').val() != "") {
        $('.form-logo').submit();
      };
    });
    $('.fancybox').fancybox();
  });
</script>
@stop