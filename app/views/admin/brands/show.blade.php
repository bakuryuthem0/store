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
        <li class="active"><a href="#"><i class="fa fa-shopping-bag"></i> Ver productos</a></li>
      </ol>
    </section>
    <div class="row">
      	<div class="col-xs-12 col-md-8 col-md-offset-2 formulario">
          	<div class="box box-success">
                <div class="box-header">
                  <i class="fa fa-comments-o"></i>
                  <h3 class="box-title">Ver productos</h3>
                </div>
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped valign-table">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Imagen</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                      </tr>
                    </thead>
                    <tbody>
                     @foreach($brands as $b)
                     <tr>
                     	<td>{{ $b->id }}</td>
                     	<td>{{ $b->name }}</td>
                      <td><img src="{{ asset('images/brands/'.$b->logo) }}" class="brand-logo center-block"></td>
                     	<td><a href="{{ URL::to('administrador/ver-marcas/modificar/'.$b->id) }}" class="btn btn-warning btn-xs">Modificar</a></td>
                     	<td><button class="btn btn-danger btn-xs btn-elim-brand" value="{{ $b->id }}" data-toggle="modal" data-target="#elimBrand">Eliminar</button></td>
                     </tr>
                     @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Imagen</th>
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
<div class="modal fade" id="elimBrand">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Eliminar Marca</h4>
			</div>
			<div class="modal-body">
        <div class="alert responseAjax">
          <p></p>
        </div>
				<p>Seguro desea eliminar este producto, esta acción es irreversible.</p>
			</div>
			<div class="modal-footer">
				<img src="{{ asset('images/loader.gif') }}" class="miniLoader">
				<button type="button" class="btn btn-danger btn-modal-elim-marca" value="" data-url="{{ URL::to('administrador/eliminar-marca') }}">Eliminar</button>
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
      });
    </script>

@stop