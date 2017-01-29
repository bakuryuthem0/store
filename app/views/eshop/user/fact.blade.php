@extends($store->template.".layouts.default")

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
                   {{ strtolower(Lang::get('lang.fact_title')) }}
                </li>
            </ul>
            <ul class="previous">
            	<li><a href="{{ URL::previous() }}">{{ Lang::get('lang.get_back') }}</a></li>
            </ul>
            <div class="clearfix"></div>
		</div>
		<h2>{{ Lang::get('lang.fact_title') }}</h2>
		<div class="table-responsive">
			<table class="table table-hover valign-table">
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