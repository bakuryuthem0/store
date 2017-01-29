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
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Titulo</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Ver Detalles</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                      </tr>
                    </thead>
                    <tbody>
                     @foreach($items as $i)
                     <tr>
                     	<td>{{ $i->id }}</td>
                     	<td>{{ $i->title_es }}</td>
                      <td>{{ $i->price }}</td>
                      <td>{{ $i->stock }}</td>
                      <td><button class="btn btn-info btn-xs show-item-info" value="{{ $i->id }}" data-toggle="modal" data-target="#showItemInfo">Ver</button></td>
                     	<td><a href="{{ URL::to('administrador/productos/modificar/'.$i->id) }}" class="btn btn-warning btn-xs">Modificar</a></td>
                     	<td><button class="btn btn-danger btn-xs btn-elim-item" value="{{ $i->id}}" data-toggle="modal" data-target="#elimItems">Eliminar</button></td>
                     </tr>
                     @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Id</th>
                        <th>Titulo</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Ver Detalles</th>
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
<div class="modal fade" id="showItemInfo">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Detalles del producto</h4>
      </div>
      <div class="modal-body">
        <div class="alert responseAjax">
          <p></p>
        </div>
        <div class="loader text-center">
          <img src="{{ asset('images/loader.gif') }}">
        </div>
        <div class="content-modal hidden">
          <h5><strong>Titulo</strong></h5>
          <p class="title es"></p>
          <p class="title eng hidden"></p>
          <h5><strong>Categoría</strong></h5>
          <p class="cat es"></p>
          <p class="cat eng hidden"></p>
          <h5><strong>Sub-Categoría</strong></h5>
          <p class="subcat es"></p>
          <p class="subcat eng hidden"></p>
          @if($store->store_type == 1)
            <h5><strong>Tallas</strong></h5>
            <ul class="size es">

            </ul>
            <ul class="size eng hidden">

            </ul>
            <h5><strong>Colores</strong></h5>
            <ul class="color es">
              
            </ul>
            <ul class="color eng hidden">

            </ul>
            <h5><strong>Materiales</strong></h5>
            <ul class="fabric es">
              
            </ul>
            <ul class="fabric eng hidden">

            </ul>
          @endif
          <h5><strong>Descripción</strong></h5>
          <div class="description es"></div>
          <div class="description eng hidden"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary details-change-lang es" value="eng" data-value="es">Cambiar idioma</button>
        <button type="button" class="btn btn-primary details-change-lang eng hidden" value="es" data-value="eng">Cambiar idioma</button>

      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="elimItems">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Eliminar Producto</h4>
			</div>
			<div class="modal-body">
        <div class="alert responseAjax">
          <p></p>
        </div>
				<p>Seguro desea eliminar este producto, esta acción es irreversible.</p>
			</div>
			<div class="modal-footer">
				<img src="{{ asset('images/loader.gif') }}" class="miniLoader">
				<button type="button" class="btn btn-danger btn-modal-elim-item">Eliminar</button>
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