@extends($store->template.".layouts.default")

@section('content')
<div class="product-big-title-area second">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>
                    	{{ Lang::get('lang.my_wishlist') }}
                    </h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- checkout -->
<div class="cart-items mid-section">
	<div class="container">
		<div class="product-breadcroumb">
            <a href="{{ URL::to('/') }}">Home</a>
            <a href="#!">
               {{ Lang::get('lang.my_wishlist') }}
            </a>
            <ul class="list-unstyled pull-right previous">
	        	<li><a href="{{ URL::previous() }}">{{ Lang::get('lang.get_back') }}</a></li>
	        </ul>
        </div>
		<div class="text-center margin-top-1"><h2>{{ Lang::get('lang.my_wishlist') }} (<span id="" class=""> {{ $wishlist->count() }} </span>)</h2></div>
		<div class="cart-gd">
			@foreach($wishlist as $i)
			<div class="row cart-header formulario">
				 <div class="cart-sec simpleCart_shelfItem margin-top-1">
					<div class="col-xs-6 col-md-4 cart-item text-center">
						 <img src="{{ strpos($i->items->imagenes->first()->image, 'lorem') ? $i->items->imagenes->first()->image : asset('images/items/'.$i->items->imagenes->first()->image) }}" class="img-responsive item_img checkout_img center-block" alt="">
					</div>
			    	<div class="col-xs-6 col-md-4">
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
							<li>
								<p>{{ Lang::get('lang.on_stock') }}: <span class="item_qty">{{ $i->items->qty }}</span></p>
							</li>
							<li>
								<h4 class="">
									{{ Lang::get('lang.price_unit') }}: <span class="item_price text-success">{{ $i->items->price }}</span>
								</h4>
							</li>
						</ul>
			    	</div>
				    <div class="col-xs-12 col-md-4 no-padding cart-item-info">
				    	<div class="col-xs-12 col-md-6">
				    		<dl class="text-left">
								<label>{{ Lang::get('lang.product_size') }}</label>
								<ul class="list-normal">
								@foreach($i->items->tallas as $t)
							  	<li class="item_size list-styled">
							  		@if(!Session::has('lang') || Session::get('lang') == 'es')
										{{ $t->description_es }}
									@else
										{{ $t->description_eng }}
									@endif
							  	</li>
							  	@endforeach
								</ul>
							  	<label>{{ Lang::get('lang.product_color') }}</label>
							  	<ul class="list-normal">
								@foreach($i->items->colores as $c)
							  	<li class="item_color">
							  		@if(!Session::has('lang') || Session::get('lang') == 'es')
										{{ $c->description_es }}
									@else
										{{ $c->description_eng }}
									@endif
							  	</li>
							  	@endforeach
							  	</ul>
							  	<label>{{ Lang::get('lang.product_fabric') }}</label>
							  	<ul class="list-normal">
								@foreach($i->items->materiales as $m)
							  	<li class="item_fabric">
							  		@if(!Session::has('lang') || Session::get('lang') == 'es')
										{{ $m->description_es }}
									@else
										{{ $m->description_eng }}
									@endif
							  	</li>
							  	@endforeach
							  	</ul>
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