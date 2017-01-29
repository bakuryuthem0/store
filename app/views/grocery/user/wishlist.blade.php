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
           {{ Lang::get('lang.fact_title') }}
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
	<div class="">
		<div class="w3ls_w3l_banner_nav_right_grid"><h3 class="text-center">{{ Lang::get('lang.my_wishlist') }} (<span id="" class=""> {{ $wishlist->count() }} </span>)</h3></div>
		<div class="cart-gd">
			@foreach($wishlist as $i)
			<div class="row cart-header formulario">
				 <div class="cart-sec simpleCart_shelfItem">
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