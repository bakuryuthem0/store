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
          @if(Session::has('danger'))
            <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              {{ Session::get('danger') }}
            </div>
          @endif
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
        
@stop

@section('postscript')

@stop