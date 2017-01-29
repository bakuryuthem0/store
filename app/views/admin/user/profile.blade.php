@extends('admin.layouts.default')

@section('content')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Admi
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Perfil</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <div class="row">
            <div class="col-md-3">
              <!-- Profile Image -->
              <div class="box box-primary avatar-box">
                <div class="box-body box-profile" style="padding:0;">
                  <img class="profile-user-img img-responsive img-circle profile-picture center-block" src="{{ asset('images/avatars/'.Auth::user()->avatar) }}" alt="User profile picture">
                </div><!-- /.box-body -->
                <div class="box-body avatar-change hidden img-circle img-responsive"  data-toggle="modal" href='#uploadImage'>
                  <p class="text-center">{{ Lang::get('lang.change_avatar') }}</p>
                </div>
                <div class="box-footer">
                  <h3 class="profile-username text-center">{{ Auth::user()->name.' '.Auth::user()->lastname }}</h3>
                </div>
              </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li @if(Session::get('act') == 'tickets' || !Session::has('act')) class="active" @endif><a href="#settings" data-toggle="tab">Configuración</a></li>
                  <li @if(Session::has('act') && Session::get('act') == 'pass') class="active" @endif><a href="#pass" data-toggle="tab">Cambiar Contraseña</a></li>

                </ul>
                <div class="tab-content">
                  <div class="tab-pane  @if(!Session::has('act') || Session::get('act') == 'perfil') active @endif" id="settings">
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      {{ Session::get('success') }}
                    </div>
                    @endif
                    <form class="form-horizontal" method="POST" action="{{ URL::to('administrador/usuario/perfil/enviar') }}" enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Nombre</label>
                        <div class="col-sm-10">
                          <input type="text" name="name" class="form-control" id="inputName" placeholder="Name" value="{{ Auth::user()->name }}">
                          @if($errors->has('name'))
                            @foreach($errors->get('name') as $err)
                            <div class="alert alert-danger">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              {{ $err }}
                            </div>
                            @endforeach
                          @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Apellido</label>
                        <div class="col-sm-10">
                          <input type="text" name="lastname" class="form-control" id="inputEmail" placeholder="Apellido" value="{{ Auth::user()->lastname }}">
                          @if($errors->has('lastname'))
                            @foreach($errors->get('lastname') as $err)
                            <div class="alert alert-danger">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              {{ $err }}
                            </div>
                            @endforeach
                          @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Avatar</label>
                        <div class="col-sm-10">
                          <input type="file" name="avatar" id="inputEmail">
                          @if($errors->has('avatar'))
                            @foreach($errors->get('avatar') as $err)
                            <div class="alert alert-danger">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              {{ $err }}
                            </div>
                            @endforeach
                          @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Enviar</button>
                        </div>
                      </div>
                    </form>
                  </div><!-- /.tab-pane -->
                   <div class="tab-pane @if(Session::has('act') && Session::get('act') == 'pass') active @endif" id="pass" >
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      {{ Session::get('success') }}
                    </div>
                    @endif
                    <form class="form-horizontal" method="POST" action="{{ URL::to('administrador/usuario/perfil/cambiar-contrasena/enviar') }}">
                      <div class="form-group">
                        <label for="inputPassOld" class="col-sm-2 control-label">Contraseña actual<br><small>(minimo 4 caracteres, Maximo 16)</small></label>
                        <div class="col-sm-10">
                          <input type="password" name="password_old" class="form-control" id="inputPassOld" placeholder="Contraseña actual">
                          @if($errors->has('password_old'))
                            @foreach($errors->get('password_old') as $err)
                            <div class="alert alert-danger">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              {{ $err }}
                            </div>
                            @endforeach
                          @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Nueva Contraseña</label>
                        <div class="col-sm-10">
                          <input type="password" name="password" class="form-control" id="inputEmail" placeholder="Nueva Contraseña">
                          @if($errors->has('password'))
                            @foreach($errors->get('password') as $err)
                            <div class="alert alert-danger">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              {{ $err }}
                            </div>
                            @endforeach
                          @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Repita la Contraseña</label>
                        <div class="col-sm-10">
                          <input type="password" name="password_confirmation" class="form-control" id="inputEmail" placeholder="Repita la Contraseña">
                          @if($errors->has('password_confirmation'))
                            @foreach($errors->get('password_confirmation') as $err)
                            <div class="alert alert-danger">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              {{ $err }}
                            </div>
                            @endforeach
                          @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Enviar</button>
                        </div>
                      </div>
                    </form>
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<a class="btn btn-primary" >Trigger modal</a>
<div class="modal fade" id="uploadImage">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Cambia tu foto de perfil.</h4>
      </div>
      <div class="modal-body">
        <form action="{{ URL::to('tienda/usuario/cambiar-avatar') }}" class="dropzone" id="profile-picture-upload" enctype="multipart/form-data">
          <div class="fallback">
            <input name="file" type="file" multiple />
          </div>
        </form>  
      </div>
      
    </div>
  </div>
</div>
@stop

@section('postscript')
<link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
{{ HTML::script('admin/dropzone.js') }}


<script type="text/javascript">
jQuery(document).ready(function($) {
  Dropzone.autoDiscover = false;
// or disable for specific dropzone:
// Dropzone.options.myDropzone = false;

  $(function() {
    // Now that the DOM is fully loaded, create the dropzone, and setup the
    // event listeners
    var myDropzone = new Dropzone(".dropzone");
    myDropzone.on("success", function(file) {
      var response = $.parseJSON(file.xhr.response);
      $('.responseAjax').addClass('active').addClass('alert-success').children('p').html(response.msg);
      $('.profile-user-img').attr('src', getRootUrl()+'/images/avatars/'+response.data);
      setTimeout(function(){
        $('.responseAjax').removeClass('alert-danger').removeClass('alert-success').removeClass('active');
      }, 5000);
    });
  })
  $('.avatar-box').hover(function() {
      $('.avatar-change').removeClass('hidden');
  }, function() {
      $('.avatar-change').addClass('hidden');
  });
});
</script>
@stop