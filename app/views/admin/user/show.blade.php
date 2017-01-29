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
        <li class="active"><a href="#"><i class="fa fa-user-plus"></i> Ver usuarios</a></li>
      </ol>
    </section>
    <div class="row">
      	<div class="col-xs-12 col-md-8 col-md-offset-2 formulario">
          	<div class="box box-success">
                <div class="box-header">
                  <i class="fa fa-comments-o"></i>
                  <h3 class="box-title">Ver usuarios</h3>
                </div>
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Cambiar contraseña</th>
                        <th>Eliminar</th>
                      </tr>
                    </thead>
                    <tbody>
                     @foreach($users as $u)
                     <tr>
                     	<td>{{ $u->id }}</td>
                     	<td>{{ $u->email }}</td>
                     	<td>{{ $u->role_desc }}</td>
                     	<td><button class="btn btn-warning btn-xs btn-change-pass" value="{{ $u->id}}" data-toggle="modal" data-target="#changePass">Cambiar</button></td>
                     	<td><button class="btn btn-danger btn-xs btn-elim-usuario" value="{{ $u->id}}" data-toggle="modal" data-target="#elimUser">Eliminar</button></td>
                     </tr>
                     @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Id</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Cambiar contraseña</th>
                        <th>Eliminar</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
      		</div>
    	</div>

  	</div><!-- /.content-wrapper -->
</div>  
<div class="modal fade" id="changePass">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Cambiar contraseña</h4>
			</div>
			<div class="modal-body">
        <div class="alert responseAjax">
          <p></p>
        </div>
				<div class="input-group">
					<label class="">Contraseña</label>
					<br>
					<label class="control-label label-control-success hidden"><i class="fa fa-check"></i> <p class="success-text"></p></label>
					<label class="control-label label-control-danger hidden"><i class="fa fa-times-circle"></i> <p class="danger-text"></p></label>
					<input type="password" name="password" class="form-control change-pass-control password" placeholder="Contraseña" >
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
					<input type="password" name="password_confirmation" class="form-control change-pass-control password_confirmation" placeholder="Repita la Contraseña" >
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
			</div>
			<div class="modal-footer">
				<img src="{{ asset('images/loader.gif') }}" class="miniLoader">
				<button type="button" class="btn btn-warning send-change-pass">Cambiar</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="elimUser">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Eliminar usuario</h4>
			</div>
			<div class="modal-body">
        <div class="alert responseAjax">
          <p></p>
        </div>
				<p>Seguro desea eliminar este usuario, esta acción es irreversible.</p>
			</div>
			<div class="modal-footer">
				<img src="{{ asset('images/loader.gif') }}" class="miniLoader">
				<button type="button" class="btn btn-danger btn-elim-users">Eliminar</button>
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