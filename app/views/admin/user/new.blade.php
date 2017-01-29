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
            <li class="active"><a href="#"><i class="fa fa-user-plus"></i> Nuevo usuario</a></li>
          </ol>
        </section>
        <div class="row">
          <div class="col-xs-12 col-md-8 col-md-offset-2 formulario">
              <div class="box box-success">
                <div class="box-header">
                  <i class="fa fa-comments-o"></i>
                  <h3 class="box-title">Nuevo usuario</h3>
                </div>
                <div class="box-body chat" id="chat-box">
                  @if(Session::has('success'))
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('success') }}
                  </div>
                  @endif
                  <form class="new-user-form" method="POST" action="{{ URL::to('administrador/usuario/nuevo/enviar') }}"> 
                    <div class="input-group">
                     <label class="">Email</label>
                     <br>
                     <label class="control-label label-control-success hidden"><i class="fa fa-check"></i> <p class="success-text"></p></label>
                     <label class="control-label label-control-danger hidden"><i class="fa fa-times-circle"></i> <p class="danger-text"></p></label>
                     <input type="email" name="email" class="form-control new-user-control" placeholder="Email" value="{{ Input::old('email') }}">
                     @if($errors->has('email'))
                        @foreach($errors->get('email') as $err)
                        <div class="clearfix"></div>
                        <div class="alert alert-danger">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          {{ $err }}
                        </div>
                        @endforeach
                      @endif
                    </div>
                    <div class="input-group">
                     <label class="">Contraseña</label>
                     <br>
                     <label class="control-label label-control-success hidden"><i class="fa fa-check"></i> <p class="success-text"></p></label>
                     <label class="control-label label-control-danger hidden"><i class="fa fa-times-circle"></i> <p class="danger-text"></p></label>
                     <input type="password" name="password" class="form-control new-user-control" placeholder="Contraseña" >
                     @if($errors->has('password'))
                        @foreach($errors->get('password') as $err)
                        <div class="clearfix"></div>
                        <div class="alert alert-danger">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          {{ $err }}
                        </div>
                        @endforeach
                      @endif
                    </div>
                    <div class="input-group">
                     <label class="">Repita la Contraseña</label>
                     <br>
                     <label class="control-label label-control-success hidden"><i class="fa fa-check"></i> <p class="success-text"></p></label>
                     <label class="control-label label-control-danger hidden"><i class="fa fa-times-circle"></i> <p class="danger-text"></p></label>
                     <input type="password" name="password_confirmation" class="form-control new-user-control" placeholder="Repita la Contraseña" >
                     @if($errors->has('password_confirmation'))
                        @foreach($errors->get('password_confirmation') as $err)
                        <div class="clearfix"></div>
                        <div class="alert alert-danger">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          {{ $err }}
                        </div>
                        @endforeach
                      @endif
                    </div>
                    <input type="hidden" name="status" class="status" value="1">
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