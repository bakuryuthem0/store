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
                  @if(!is_null($store->store_logo))
                    <div class="formulario">
                      <img src="{{ asset('images/'.ShopType::getLogo()) }}" class="img-responsive center-block">
                    </div>
                  @endif
                  <form method="POST" action="{{ URL::to('administrador/tienda/agregar-logo/enviar') }}" enctype="multipart/form-data" class="form-logo">
                    <div class="formulario bg-warning">
                      <p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Se recomienda que la resolución de la imagen sea no menor a 100px de alto y un peso maximo de 3Mb</p>
                    </div>
                    <div class="formulario">
                      <input type="file" class="file" name="logo">
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
<script type="text/javascript">
  $('.btn-send').on('click', function(event) {
    if ($('.file').val() != "") {
      $('.form-logo').submit();
    };
  });
</script>
@stop