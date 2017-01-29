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
                   {{ Lang::get('lang.checkout') }}
                </li>
            </ul>
            <ul class="previous">
            	<li><a href="{{ URL::previous() }}">{{ Lang::get('lang.get_back') }}</a></li>
            </ul>
            <div class="clearfix"></div>
		</div>
		<h2>{{ Lang::get('lang.my_cart') }} (<span id="simpleCart_quantity" class="simpleCart_quantity"> 0 </span>)</h2>
		<div class="cart-gd">
			<div class="row cart-header new-cart to-clone">
				 <div class="cart-sec simpleCart_shelfItem">
					<div class="col-xs-12 cart-item cyc">
						 <img src="" class="img-responsive item_img checkout_img" alt="">
					</div>
				    <div class="col-xs-12 no-padding cart-item-info">
				    	<div class="col-xs-12 col-md-6">
							<h3><a href="#!" class="item_name"> </a></h3>
							<ul class="qty list-unstyled formulario">
								<li><p>{{ Lang::get('lang.order_qty') }}: <span class="item_qty"></span></p></li>
								<li><p>{{ Lang::get('lang.price_unit') }}: <span class="item_price"></span></p></li>
							</ul>
				    	</div>
				    	<div class="col-xs-12 col-md-6">
				    		<dl class="dl-horizontal">
								<dt>{{ Lang::get('lang.product_size') }}</dt>
							  	<dd class="item_size"><img src="{{ asset('images/loader.gif') }}" class="miniLoader active"></dd>
							  	<dt>{{ Lang::get('lang.product_color') }}</dt>
							  	<dd class="item_color"><img src="{{ asset('images/loader.gif') }}" class="miniLoader active"></dd>
							  	<dt>{{ Lang::get('lang.product_fabric') }}</dt>
							  	<dd class="item_fabric"><img src="{{ asset('images/loader.gif') }}" class="miniLoader active"></dd>
							</dl>
				    	</div>
						<div class="col-xs-12">
							<strong>Sub-total : <span class="item_sub_total text-success"></span></strong>
							<div class="clearfix"></div>
				        </div>	
				   </div>
				   <div class="clearfix"></div>
			  	</div>
			</div>
			<form method="POST" action="{{ URL::to('tienda/checkout/procesar') }}" class="form-checkout">

			</form>
			<div class="col-xs-12 text-right">
				<p class="valign">{{ Lang::get('lang.checkout_terms') }}</p>
				<a href="javascript:;" data-href="{{ URL::to('tienda/checkout/procesar') }}" class="btn btn-default valign left-margin btn-checkout">{{ Lang::get('lang.process') }}</a>
			</div>
		</div>
	</div>
</div>

<!-- //checkout -->	
@stop

@section('postscript')
<script type="text/javascript">
	function clonarCheckout(item) {
		var toClone = $('.new-cart');
		var cloned = toClone.clone();
		toClone.removeClass('new-cart').addClass('active');
		toClone.find('.item_name').attr('href', getRootUrl()+'/tienda/ver-producto/'+item.get('product')).html(item.get('name'));
		toClone.find('.item_qty').html(item.get('quantity'));
		toClone.find('.item_price').html(item.get('price'));
		toClone.find('.item_sub_total').html(item.get('total'));
		toClone.find('.item_img').attr('src',item.get('img'));
		$.get(getRootUrl()+'/tienda/buscar-talla/'+item.get('size'), function(response) {
			toClone.find('.item_size').html(response.data);
		});
		$.get(getRootUrl()+'/tienda/buscar-color/'+item.get('color'), function(response) {
			toClone.find('.item_color').html(response.data);
		});
		$.get(getRootUrl()+'/tienda/buscar-tela/'+item.get('fabric'), function(response) {
			toClone.find('.item_fabric').html(response.data);
		});

		toClone.after(cloned);
		$('.form-checkout').append('<input type="hidden" name="item_product['+item.get('product')+']" value="'+item.get('product')+'">');
		$('.form-checkout').append('<input type="hidden" name="item_qty['+item.get('product')+']" value="'+item.get('quantity')+'">');
		$('.form-checkout').append('<input type="hidden" name="item_size['+item.get('product')+']" value="'+item.get('size')+'">');
		$('.form-checkout').append('<input type="hidden" name="item_color['+item.get('product')+']" value="'+item.get('color')+'">');
		$('.form-checkout').append('<input type="hidden" name="item_fabric['+item.get('product')+']" value="'+item.get('fabric')+'">');

	}
	$(window).load(function() {
		$('.btn-checkout').on('click', function(event) {
			$('.form-checkout').submit();
		});
		simpleCart.each(function(item){
			clonarCheckout(item);
		})
		simpleCart.bind( 'update' , function(){
			$('.to-clone.active').remove();
			simpleCart.each(function(item){
				clonarCheckout(item);
			})
		});
	});
</script>
@stop