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
        <li class="active"><a href="#"><i class="fa fa-shopping-bag"></i> Ver facturas</a></li>
      </ol>
    </section>
    <div class="row">
      	<div class="col-xs-12 formulario">
          	<div class="box box-success">
                <div class="box-header">
                  <i class="fa fa-comments-o"></i>
                  <h3 class="box-title">Ver facturas </h3>
                </div>
                <div class="box-body content-fluid">
                  <table id="example1" class="table table-bordered table-striped valign-table">
                    <thead>
                    	<tr>
							<th>Id</th>
							<th>Usuario</th>
							<th>{{ Lang::get('lang.order_qty') }}</th>
							<th>Total</th>
							<th>Ver detalles de la compra</th>
							<th>Ver detalles del pago</th>
							<th>Aprobar</th>
							<th>Rechazar</th>
                    	</tr>
					</thead>
					<tbody>
						@foreach($payments as $f)
						<tr>
							<td>{{ $f->id }}</td>
							<td>
								{{ $f->users->email }}
							</td>
							<td>
								<ul>
									<?php $qty = 0; ?>
									@foreach($f->compras as $c)
											<?php $qty = $c->qty+$qty; ?>
									@endforeach
									<li>
										<?php echo $qty; ?>
									</li>
								</ul>
							</td>
							<td>
								<?php $total = 0; ?>
								@foreach($f->compras as $c)
									<?php $total = $total+($c->qty*$c->items->price); ?>
								@endforeach
								<p class="text-success">{{ $total }}</p>
							</td>
							<td>
								<button class="btn btn-primary btn-xs center-block pursache-details" data-toggle="modal" data-target="#showPurchaseInfo" data-value='{{ $f }}'>Ver</button>
							</td>
							<td>
								<button class="btn btn-info btn-xs center-block payment-details" data-value='{{ $f->payments }}' data-toggle="modal" data-target="#paymentInfo">Ver</button>
							</td>
							<td>
								<button class="btn btn-success btn-xs center-block btn-aprove" value='{{ $f->payments['id'] }}' data-toggle="modal" data-target="#aprovePursache">Aprobar</button>
							</td>
							<td>
								<button class="btn btn-danger btn-xs center-block btn-reject" value='{{ $f->payments['id'] }}' data-toggle="modal" data-target="#rejectPayment">Rechazar</button>
							</td>
						</tr>
						@endforeach
					</tbody>
                    <tfoot>
                      	<tr>
							<th>Id</th>
							<th>Usuario</th>
							<th>{{ Lang::get('lang.order_qty') }}</th>
							<th>Total</th>
							<th>Ver detalles de la compra</th>
							<th>Ver detalles del pago</th>
							<th>Aprobar</th>
							<th>Rechazar</th>
						</tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
      		</div>
    	</div>

  	</div><!-- /.content-wrapper -->
</div>  
<div class="modal big fade" id="showPurchaseInfo">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Detalles de la compra</h4>
      </div>
      <div class="modal-body">
        <div class="content-modal">
			<div class="table-responsive">
        		<table class="table table-hover valign-table">
        			<thead>
        				<tr>
        					<th>
        						Producto(s)
        					</th>
        					<th>
        						Cantidad
        					</th>
        					@if($store->store_type == 1)
        						<th>
        							Talla(s)
        						</th>
        						<th>
        							Color(es)
        						</th>
        						<th>
        							Material(es)
        						</th>
        					@endif
        					<th>
        						Precio Unitario
        					</th>
        					<th>
        						Subtotal
        					</th>
        					<th>
        						Total
        					</th>
        				</tr>
        			</thead>
        			<tbody>
        				<tr>
        					<td>
        						<ul class="modal-items">
        						</ul>
        					</td>
        					<td>
        						<ul class="modal-qty">
        						</ul>
        					</td>
        					@if($store->store_type == 1)
        					<td>
        						<ul class="modal-size">

        						</ul>
        					</td>
        					<td>
        						<ul class="modal-color">

        						</ul>
        					</td>
        					<td>
        						<ul class="modal-fabric">

        						</ul>
        					</td>
        					@endif
        					<td>
        						<ul class="modal-price">
        						</ul>
        					</td>
        					<td>
        						<ul class="modal-subtotal">
        						</ul>
        					</td>
        					<td>
        						<p class="modal-total text-success">
        						</p>
        					</td>
        				</tr>
        			</tbody>
        		</table>
        	</div>        	
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade big" id="paymentInfo">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Información del pago</h4>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-hover valign-table">
						<thead>
							<tr>
								<th class="text-center">
									Metodo de pago
								</th>
								<th class="method-transfer hidden">
									Banco emisor
								</th>
								<th class="text-center">
									Banco
								</th>
								<th class="text-center">
									Numero de referencia
								</th>
								<th class="text-center">
									Fecha de transacción
								</th>
							</tr>
						</thead>
						<tbody>
							<tr class="text-center">
								<td class="transaction_method-modal"></td>
								<td class="user_bank-modal method-transfer hidden"></td>
								<td class="shop_bank-modal"></td>
								<td class="reference_number-modal"></td>
								<td class="transaction_date-modal"></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="aprovePursache">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Aprobar pago</h4>
			</div>
			<div class="modal-body">
				<div class="responseAjax alert">
					<p></p>
				</div>
				¿Seguro desea realizar esta acción?, esto es irreVersible.
			</div>
			<div class="modal-footer">
				<img src="{{ asset('images/loader.gif') }}" class="miniLoader">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-success btn-modal-aprove-pursache">Aprobar</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="rejectPayment">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Rechazar pago</h4>
			</div>
			<div class="modal-body">
        <div class="alert responseAjax">
          <p></p>
        </div>
				<p>¿Seguro desea realizar esta acción?, esta acción es irreversible.</p>

				<div class="alert alert-warning">
					<p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Por favor introduzca el motivo por el cual esta rechazando este pago.</p>
				</div>
				<textarea class="form-control modal-motivo" name=""></textarea>
			</div>
			<div class="modal-footer">
				<img src="{{ asset('images/loader.gif') }}" class="miniLoader">
				<button type="button" class="btn btn-danger btn-modal-reject-pursache">Eliminar</button>
			</div>
		</div>
	</div>
</div>
<input type="hidden" class="store_type" value="{{ $store->store_type }}">
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