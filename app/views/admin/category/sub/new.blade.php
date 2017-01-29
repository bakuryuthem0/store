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
      <li class=""><a href="{{ URL::to('administrador') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><a href="{{ Request::url() }}"><i class="fa fa-list"></i> Nueva Sub-Categoría</a></li>
    </ol>
  </section>
  <div class="row">
    <div class="col-xs-12 col-md-10 col-md-offset-1 formulario">
      <div class="box box-success">
        <div class="box-header">
          <i class="fa fa-list"></i>
          <h3 class="box-title">Nueva Sub-Categoría</h3>
        </div>
        <div class="box-body chat" id="chat-box">
          @if(Session::has('success'))
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('success') }}
          </div>
          @elseif(Session::has('danger'))
          <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('danger') }}
          </div>
          @endif
          <div class="alert responseAjax">
            <p></p>
          </div>
          <div class="col-xs-12">
            <form class="new-user-form" method="POST" action="{{ URL::to('administrador/sub-categoria/nueva/enviar') }}"  enctype="multipart/form-data">
              <div class="input-group">
                <label>(*) Categoría</label>
              </div>
              <div class="input-group">
                <select class="form-control" name="cat_id">
                  <option value="">Seleccione una opción...</option>
                  @foreach($cat as $c)
                    <option value="{{ $c->id }}">{{ $c->description_es }}</option>
                  @endforeach
                </select>
              </div>
              <div class="input-group">
                <label>(*) Nombre de la sub-categoría (español)</label>
              </div>
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Nombre de la sub-categoría" name="name">
              </div>
              <div class="input-group">
                <label>(*) Nombre de la sub-categoría (ingles)</label>
              </div>
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Nombre de la sub-categoría (ingles)" name="name_eng">
              </div>
            </form>
          </div>
          
        </div><!-- /.chat -->
        <div class="box-footer">
          <div class="col-xs-12"><button class="btn btn-success btn-new-user">Enviar</button></div>
        </div>
      </div><!-- /.box (chat box) -->
    </div>
  </div>
</div><!-- /.content-wrapper -->
        
@stop

@section('postscript')

@stop