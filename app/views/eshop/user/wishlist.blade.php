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
                   {{ Lang::get('lang.fact_title') }}
                </li>
            </ul>
            <ul class="previous">
            	<li><a href="{{ URL::previous() }}">{{ Lang::get('lang.get_back') }}</a></li>
            </ul>
            <div class="clearfix"></div>
		</div>
		<h2>{{ Lang::get('lang.my_wishlist') }} (<span id="" class=""> {{ $wishlist->count() }} </span>)</h2>
		<div class="cart-gd">
			@foreach($wishlist as $i)
			<div class="row cart-header">
				 <div class="cart-sec simpleCart_shelfItem">
					<div class="col-xs-12 cart-item cyc">
						 <img src="{{ strpos($i->items->imagenes->first()->image, 'lorem') ? $i->items->imagenes->first()->image : asset('images/items/'.$i->items->imagenes->first()->image) }}" class="img-responsive item_img checkout_img" alt="">
					</div>
				    <div class="col-xs-12 no-padding cart-item-info">
				    	<div class="col-xs-12 col-md-6">
							<h3>
								<a href="#!" class="item_name">
									@if(!Session::has('lang') || Session::get('lang') == 'es')
										{{ $i->items->title_es }}
									@else
										{{ $i->items->title_eng }}
									@endif
								</a>
							</h3>
							<ul class="qty list-unstyled formulario">
								<li><p>{{ Lang::get('lang.on_stock') }}: <span class="item_qty">{{ $i->items->qty }}</span></p></li>
								<li><p>{{ Lang::get('lang.price_unit') }}: <span class="item_price">{{ $i->items->price }}</span></p></li>
							</ul>
				    	</div>
				    	<div class="col-xs-12 col-md-6">
				    		<dl class="dl-horizontal">
				    			@if($store->store_type == 1)
									<dt>{{ Lang::get('lang.product_size') }}</dt>
									@foreach($i->items->tallas as $t)
								  	<dd class="item_size">
								  		@if(!Session::has('lang') || Session::get('lang') == 'es')
											{{ $t->description_es }}
										@else
											{{ $t->description_eng }}
										@endif
								  	</dd>
								  	@endforeach
								  	<dt>{{ Lang::get('lang.product_color') }}</dt>
									@foreach($i->items->colores as $c)
								  	<dd class="item_color">
								  		@if(!Session::has('lang') || Session::get('lang') == 'es')
											{{ $c->description_es }}
										@else
											{{ $c->description_eng }}
										@endif
								  	</dd>
								  	@endforeach
								  	<dt>{{ Lang::get('lang.product_fabric') }}</dt>
									@foreach($i->items->materiales as $m)
								  	<dd class="item_fabric">
								  		@if(!Session::has('lang') || Session::get('lang') == 'es')
											{{ $m->description_es }}
										@else
											{{ $m->description_eng }}
										@endif
								  	</dd>
								  	@endforeach
								@endif
							</dl>
							<a href="{{ URL::to('tienda/ver-producto/'.$i->items->id) }}" class="btn btn-default center-block">{{ Lang::get('lang.see_details') }}</a>
				    	</div>
				   </div>
				   <div class="clearfix"></div>
			  	</div>
			</div>
			@endforeach
		</div>
	</div>
</div>

<!-- //checkout -->	
@stop

@section('postscript')

<script type="text/javascript">
</script>
@stop