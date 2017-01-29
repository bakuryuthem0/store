@extends($store->template.'.layouts.default')

@section('content')
<!-- checkout -->
<div class="cart-items">
  <div class="container">
    <div class="dreamcrub">
      <ul class="breadcrumbs">
        <li class="home">
          <a href="index.html" title="Go to Home Page">{{ Lang::get('lang.home_title') }}</a>&nbsp;
            <span>&gt;</span>
        </li>
        <li class="women">
          {{ strtolower(Lang::get('lang.profile')) }}
        </li> 
      </ul>
      <ul class="previous">
        <li><a href="{{ URL::previous() }}">{{ Lang::get('lang.get_back') }}</a></li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <h2>{{ Lang::get('lang.profile') }}</h2>
    <div class="row">
      <div class="col-md-3">
        <!-- Profile Image -->
        <div class="box box-primary avatar-box">
          <div class="box-body box-profile">
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
            <li @if(Session::get('act') == 'perfil' || !Session::has('act')) class="active" @endif><a href="#settings" data-toggle="tab">Configuración</a></li>
            <li @if(Session::has('act') && Session::get('act') == 'pass') class="active" @endif><a href="#pass" data-toggle="tab">Cambiar Contraseña</a></li>
            <li @if(Session::has('act') && Session::get('act') == 'shipping') class="active" @endif><a href="#shipping" data-toggle="tab">Drecciones de envio</a></li>

          </ul>
          <div class="tab-content">
            <div class="tab-pane fade in  @if(!Session::has('act') || Session::get('act') == 'perfil') active in @endif" id="settings">
              @if(Session::has('success'))
              <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ Session::get('success') }}
              </div>
              @endif
              <form class="form-horizontal" method="POST" action="{{ URL::to('tienda/usuario/modificar-perfil/enviar') }}" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label">{{ Lang::get('lang.register_firstname') }}</label>
                  <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" id="inputName" placeholder="{{ Lang::get('lang.register_firstname') }}" value="{{ Auth::user()->name }}">
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
                  <label for="inputEmail" class="col-sm-2 control-label">{{ Lang::get('lang.register_lastname') }}</label>
                  <div class="col-sm-10">
                    <input type="text" name="lastname" class="form-control" id="inputEmail" placeholder="{{ Lang::get('lang.register_lastname') }}" value="{{ Auth::user()->lastname }}">
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
                  <label for="inputEmail" class="col-sm-2 control-label">{{ Lang::get('lang.register_address') }}</label>
                  <div class="col-sm-10">
                    <textarea name="address" class="form-control" placeholder="{{ Lang::get('lang.register_address') }}">{{ Auth::user()->address }}</textarea>
                    @if($errors->has('address'))
                      @foreach($errors->get('address') as $err)
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
                    <button type="submit" class="btn btn-primary">Enviar</button>
                  </div>
                </div>
              </form>
            </div><!-- /.tab-pane fade -->
             <div class="tab-pane fade @if(Session::has('act') && Session::get('act') == 'pass') active in @endif" id="pass" >
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
                    <button type="submit" class="btn btn-primary">Enviar</button>
                  </div>
                </div>
              </form>
            </div><!-- /.tab-pane fade -->
            <div class="tab-pane  @if(Session::has('act') && Session::get('act') == 'shipping') active in @endif" id="shipping">
              @if(Session::has('success'))
              <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ Session::get('success') }}
              </div>
              @endif
              <form class="form-horizontal" method="POST" action="{{ URL::to('tienda/usuario/envios/enviar') }}" enctype="multipart/form-data">
                <div class='form-group'>
                  <div class="table-responsive">
                    <table class="table table-hover valign-table">
                      <thead>
                        <tr>
                          <th>{{ Lang::get('lang.default') }}</th>
                          <th>{{ Lang::get('lang.address') }}</th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <input type="radio" value="user_address" checked name="default">
                          </td>
                          <td>
                            <textarea class="form-control">{{ Auth::user()->address }}</textarea>
                          </td>
                          <td>
                            @if(empty($default) || is_null($default)) {{ Lang::get('lang.default_address') }} @endif
                          </td>
                          <td>
                          </td>
                        </tr>
                        @if(!empty($default) && !is_null($default))
                          <tr>
                            <td>
                              <input type="radio" value="{{ $default->id }}" checked name="default">
                            </td>
                            <td>
                              <textarea class="form-control">{{ $default->address }}</textarea>
                            </td>
                            <td>
                              <label>{{ Lang::get('lang.default_address') }}</label>
                            </td>
                            <td>
                              <button type="button" class="close btn-elim-thing" data-id="{{ $default->id }}" data-toggle="modal" data-target="#elimThing" data-url="{{ URL::to('tienda/usuario/eliminar-direccion') }}" data-what-to-elim="{{ Lang::get('lang.address') }}">
                                <i class="fa fa-times-circle"></i>
                              </button>
                            </td>
                          </tr>
                        @endif
                        @foreach($dir as $d)
                          <tr>
                            <td>
                              <input type="radio" value="{{ $d->id }}" class="saved" name="default">
                            </td>
                            <td>
                              <textarea class="form-control">{{ $d->address }}</textarea>
                            </td>
                            <td>
                            </td>
                            <td class="relative">
                              <button type="button" class="close btn-elim-thing" data-id="{{ $d->id }}" data-toggle="modal" data-target="#elimThing" data-url="{{ URL::to('tienda/usuario/eliminar-direccion') }}" data-what-to-elim="{{ Lang::get('lang.address') }}">
                                <i class="fa fa-times-circle"></i>
                              </button>
                            </td>
                          </tr>
                        @endforeach
                        <tr class="to-clone new-address">
                          <td>
                            <input type="radio" value="" class="default" name="default">
                          </td>
                          <td>
                            <textarea class="form-control" name=""></textarea>
                          </td>
                          <td>
                          </td>
                          <td class="relative">
                            <button type="button" class="close dimiss-cloned">
                              <i class="fa fa-times-circle"></i>
                            </button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="form-group">
                  <button class="btn btn-primary pull-left btn-clone" data-target="new-address" data-name="address" type="button">Agegar</button>
                  <button class="btn btn-success pull-right">Enviar</button>
                </div>
              </form>
            </div><!-- /.tab-pane fade -->
          </div><!-- /.tab-content -->
        </div><!-- /.nav-tabs-custom -->
      </div><!-- /.col -->

    </div>
  </div>
</div>
<div class="modal fade" id="uploadImage">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Cambia tu foto de perfil.</h4>
      </div>
      <div class="modal-body">
        <div class="responseAjax alert">
          <p></p>
        </div>
        <form action="{{ URL::to('tienda/usuario/cambiar-avatar') }}" class="dropzone" id="profile-picture-upload" enctype="multipart/form-data">
          <div class="fallback">
            <input name="file" type="file" multiple />
          </div>
        </form>  
      </div>
      
    </div>
  </div>
</div>
{{ View::make('partials.modalElim') }}
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
  
  $('.btn-clone').on('click', function(event) {
    var target = $(this).data('target');
    var name = $(this).data('name');
    var id = $('.saved').length;
    if (id == 0) {
      var id = $('.to-clone.active').length;
    }
    var toClone = clonar(target, name+'['+id+']');

    toClone.find('.default').val(id);
  });
  $(document).on('click','.dimiss-cloned', function(event) {
    removeCloned($(this));
  });
  $('.btn-elim-thing').on('click', function(event) {
    var btn = $(this);
    var name    = btn.data('what-to-elim');
    var url   = btn.data('url');
    btn.addClass('to-elim');
    $('.what-to-elim').html(name);
    $('.btn-elim-thing-modal').val(btn.data('id')).attr('data-url',url);
  });
  $('.btn-elim-thing-modal').on('click', function(event) {
    var btn = $(this);
    var dataPost = {
      'id' : btn.val()
    };
    var url = btn.data('url');
    elimAjax(url, dataPost, btn, 'POST');
  });
});
</script>
@stop