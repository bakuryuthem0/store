@extends($store->template.".layouts.default")

@section('content')
<!-- products-breadcrumb -->
  <div class="products-breadcrumb">
    <div class="container">
      <ul class="col-xs-6 col-md-3">
        <li>
          <i class="fa fa-home" aria-hidden="true"></i>
          <a href="{{ URL::to('/') }}">{{ Lang::get('lang.home_title') }}</a>
          <span>|</span>
        </li>
        <li>
           {{ strtolower(Lang::get('lang.fact_title')) }}
        </li>
      </ul>
      <ul class="col-xs-6 col-md-3 previous pull-right text-right">
	    <li><a href="{{ URL::previous() }}">{{ Lang::get('lang.get_back') }}</a></li>
	  </ul>
    </div>
  </div>
<!-- //products-breadcrumb -->
<!-- checkout -->
<div class="cart-items mid-section">
	<div class="row">
		<div class="w3ls_w3l_banner_nav_right_grid"><h3 class="text-center">{{ Lang::get('lang.fact_title') }}</h3></div>
		<div class="col-xs-12 col-md-11 center-block table-responsive ">
			<table class="table table-hover table-striped valign-table">
				<thead>
					<tr>
						<th>Id</th>
						<th>{{ Lang::get('lang.items') }}</th>
						<th>{{ Lang::get('lang.order_qty') }}</th>
						<th>{{ Lang::get('lang.price_unit') }}</th>
						<th>Sub-Total</th>
						<th>Total</th>
						<th>Status</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($fact as $f)
					<tr>
						<td>{{ $f->id }}</td>
						<td>
							<ul>
							@foreach($f->compras as $c)
								<li>
									@if(!Session::has('lang') || Session::get('lang') == 'es')
										{{ $c->items->title_es }}
									@else
										{{ $c->items->title_eng }}
									@endif
								</li>
							@endforeach
							</ul>
						</td>
						<td>
							<ul>
							@foreach($f->compras as $c)
								<li>
									{{ $c->qty }}
								</li>
							@endforeach
							</ul>
						</td>
						<td>
							<ul>
							@foreach($f->compras as $c)
								<li>
									{{ $c->items->price }}
								</li>
							@endforeach
							</ul>
						</td>
						<td>
							<ul>
							@foreach($f->compras as $c)
								<li>
									{{ $c->qty*$c->items->price }}
								</li>
								<?php $total = $total+$c->qty*$c->items->price; ?>
							@endforeach
							</ul>
						</td>
						<td>
							<h3 class="text-success">{{ $total }}</h3>
						</td>
						<td>
							@if($f->was_paid == 0)
								<i class="fa fa-times text-danger fa-2x" data-toggle="tooltip" data-title="{{ Lang::get('lang.unpaid_bill') }}"></i>
							@elseif($f->was_paid == 1)
								<i class="fa fa-clock-o text-info fa-2x" data-toggle="tooltip" data-title="{{ Lang::get('lang.paid_bill_processing') }}"></i>
							@elseif($f->was_paid == 2)
								<i class="fa fa-check text-success fa-2x" data-toggle="tooltip" data-title="{{ Lang::get('lang.paid_bill') }}"></i>
							@endif
						</td>
						<td>
							<a href="{{ URL::to('tienda/usuario/ver-compra/'.$f->id) }}">{{ Lang::get('lang.see_details') }}</a>
						</td>
						<td>

						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- //checkout -->	
@stop

@section('postscript')
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('[data-toggle="tooltip"]').tooltip();
	});
</script>
@stop