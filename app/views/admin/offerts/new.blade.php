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
          <div class="col-xs-12 center-block">
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
                  <form method="POST" action="{{ URL::to('administrador/nueva-oferta/enviar') }}" enctype="multipart/form-data" class="form">
                    <div class="row">
                      <div class="formulario col-xs-12 col-md-6">
                        <label>(*) Título de la oferta (español)</label>
                        <input type="text" name="title_es" class="form-control" value="{{ Input::old('title_es') }}">
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
                      <div class="formulario col-xs-12 col-md-6">
                        <label>(*) Título de la oferta (ingles)</label>
                        <input type="text" name="title_eng" class="form-control" value="{{ Input::old('title_eng') }}">
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
                    <div class="row">
                      <div class="formulario col-xs-12 col-md-6">
                        <label>Sub-título de la oferta (español)</label>
                        <input type="text" name="subtitle_es" class="form-control" value="{{ Input::old('subtitle_es') }}">
                        @if($errors->has('subtitle_es'))
                          @foreach($errors->get('subtitle_es') as $err)
                          <div class="clearfix"></div>
                          <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ $err }}
                          </div>
                          @endforeach
                        @endif
                      </div>
                      <div class="formulario col-xs-12 col-md-6">
                        <label>Sub-título de la oferta (ingles)</label>
                        <input type="text" name="subtitle_eng" class="form-control" value="{{ Input::old('subtitle_eng') }}">
                        @if($errors->has('subtitle_eng'))
                          @foreach($errors->get('subtitle_eng') as $err)
                          <div class="clearfix"></div>
                          <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ $err }}
                          </div>
                          @endforeach
                        @endif
                      </div>
                    </div>
                    <div class="row">
                      <div class="formulario col-xs-12">
                        <label>Procentaje</label>
                        <div class="input-group">
                          <input type="text" name="percent" class="form-control" value="{{ Input::old('percent') }}">
                          <div class="input-group-addon">%</div>
                        </div>
                        @if($errors->has('percent'))
                          @foreach($errors->get('percent') as $err)
                          <div class="clearfix"></div>
                          <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ $err }}
                          </div>
                          @endforeach
                        @endif
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-12 formulario">
                        <div class="table-responsive">
                          <table id="example1" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th class="text-center">Id</th>
                                <th class="text-center">Item</th>
                                <th class="text-center">Ver</th>
                                <th class="text-center">Seleccionar</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($items as $key => $i)
                              <tr>
                                <td>{{ $i->id }}</td>
                                <td>{{ $i->title_es }}</td>
                                <td><a target="_blank" href="{{ URL::to('administrador/ver-articulo/'.$i->id) }}" class="btn btn-xs btn-primary">Ver</a></td>
                                <td>
                                  <input type="checkbox" name="item_id[{{ $i->id }}]" value="{{ $i->id }}" @if(Input::old('item_id') && Input::old('item_id['.$key.']') == $i->id) checked @endif>
                                </td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div> 
                      </div>
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

{{ HTML::style('plugins/datatables/dataTables.bootstrap.css') }}
{{ HTML::script('plugins/datatables/jquery.dataTables.min.js') }}
{{ HTML::script('plugins/datatables/dataTables.bootstrap.min.js') }}

<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
    $('.btn-send').on('click', function(event) {
      $('.form').submit();
    });
  });
</script>
@stop