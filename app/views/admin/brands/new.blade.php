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
            <li class="active"><a href="#"><i class="fa fa-user-plus"></i> Nueva Marca</a></li>
          </ol>
        </section>
        <div class="row">
          <div class="col-xs-12 col-md-8 col-md-offset-2 formulario">
              <div class="box box-success">
                <div class="box-header">
                  <i class="fa fa-comments-o"></i>
                  <h3 class="box-title">Nueva Marca</h3>
                </div>
                <div class="box-body chat" id="chat-box">
                  @if(Session::has('success'))
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('success') }}
                  </div>
                  @endif
                  <form class="new-user-form" method="POST" action="{{ URL::to('administrador/nueva-marca/enviar') }}" enctype="multipart/form-data"> 
                    <div class="input-group">
                      <label>Nombre de la marca</label>
                      <input type="text" class="form-control" name="name" value="{{ Input::old('name') }}">
                    </div>
                    <div class="input-group">
                      <label>Logo de la marca</label>
                      <input type="file" name="logo">
                    </div>
                  </form>
                </div><!-- /.chat -->
                <div class="box-footer">
                  <button class="btn btn-success btn-new-user">Enviar</button>
                </div>
              </div><!-- /.box (chat box) -->

          </div>
        </div>

      </div><!-- /.content-wrapper -->
        
@stop