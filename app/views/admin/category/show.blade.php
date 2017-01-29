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
        <li class=""><a href="{{ URL::to('administrador/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class=""><a href="{{ URL::to('administrador/departamentos/ver') }}"><i class="fa fa-list"></i> Categorías</a></li>
        <li class="active"><a href="{{ Request::url() }}"><i class="fa fa-search"></i> Ver categorías</a></li>

      </ol>
    </section>
    <div class="row">
      	<div class="col-xs-12 col-md-10 col-md-offset-1 formulario">
          	<div class="box box-success">
                <div class="box-header">
                  <i class="fa fa-list"></i>
                  <h3 class="box-title">Ver categorías</h3>
                </div>
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped menu-cat-table">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Nombre (español)</th>
                        <th>Nombre (ingles)</th>
                        <th>Mostrar en menu</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                      </tr>
                    </thead>
                    <tbody>
                     @foreach($cat as $c)
                     <tr>
                     	<td>{{ $c->id }}</td>
                     	<td>{{ $c->description_es }}</td>
                      <td>{{ $c->description_eng }}</td>
                      <td>
                        <img src="{{ asset('images/loader.gif') }}" class="miniLoader">
                        <input type="checkbox" class="menu_active" data-url="{{ URL::to('activar-categorias-menu') }}" data-max-text="3 categorías" data-length="3" name="menu_cat_{{ $c->id }}" value="{{ $c->id }}" @if($c->menu_active == 1) checked @endif>
                      </td>
                      <td>
                        <a class="btn btn-warning btn-xs" href="{{ URL::to('administrador/categorias/ver-categorias/'.$c->id) }}"> 
                          Modificar
                        </a>
                      </td>
                     	<td>
                        <button class="btn btn-danger btn-xs btn-elim-cat" value="{{ $c->id}}" data-toggle="modal" data-target="#elimCat"> 
                          Eliminar
                        </button>
                      </td>
                     </tr>
                     @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Id</th>
                        <th>Nombre (español)</th>
                        <th>Nombre (ingles)</th>
                        <th>Mostrar en menu</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
      		</div>
    	</div>

  	</div><!-- /.content-wrapper -->
</div>  
<div class="modal fade" id="elimCat">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Eliminar Categoría</h4>
			</div>
			<div class="modal-body">
        <div class="alert responseAjax">
          <p></p>
        </div>
				<p>Seguro desea realizar esta acción?.</p>
			</div>
			<div class="modal-footer">
				<img src="{{ asset('images/loader.gif') }}" class="miniLoader">
				<button type="button" class="btn btn-danger btn-elim-cat-modal">Eliminar</button>
			</div>
		</div>
	</div>
</div>
@stop

@section('postscript')
    {{ HTML::style('admin/plugins/datatables/dataTables.bootstrap.css') }}
    {{ HTML::script('admin/plugins/datatables/jquery.dataTables.min.js') }}
    {{ HTML::script('admin/plugins/datatables/dataTables.bootstrap.min.js') }}
    <script>
      $(function () {
        $('#example1').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
        $(document).on('click','.menu_active', function(event) {
          var table = $('.menu-cat-table').DataTable();
          var checked = $(table.rows().nodes()).find('.menu_active:checked').length
          var check     = $(this);
          var length    = check.data('length');
          var max_text  = check.data('max-text');
          var url     = check.data('url');

          checkMenuCat(check, length, max_text, url, checked);
        });
      });
    </script>

@stop