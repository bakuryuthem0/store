@extends('admin.layouts.default')

@section('content')

<div class="login-box">
  <div class="login-logo logo-login">
    <a href="{{ URL::to('administrador') }}"><b>Sistema de administracion nombredelapagina</b></a>
  </div><!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Iniciar Sesión</p>
    @if(Session::has('danger'))
    <div class="alert alert-danger">
      <p>{{ Session::get('danger') }}</p>
    </div>
    @endif
    <div class="alert responseAjax">
        <p></p>
    </div>
    <form action="{{ URL::to('administrador/login/enviar') }}" method="post">
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control email" placeholder="Usuario">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control password" placeholder="Contraseña">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      {{ Form::token() }}
    </form>
    <div class="row">
      <div class="col-xs-8 pull-right">
        <button type="submit" class="btn btn-primary btn-block btn-flat logMeIn">Iniciar Sesión</button>
      </div><!-- /.col -->
      <div class="col-xs-2 pull-right no-padding"><img src="{{ asset('images/loader.gif') }}" class="pull-right miniLoader"></div>
    </div>

    <a href="#">Olvide mi contraseña</a><br>

  </div><!-- /.login-box-body -->
</div><!-- /.login-box -->
@stop

@section('postscript')
<script type="text/javascript">
</script>
@stop