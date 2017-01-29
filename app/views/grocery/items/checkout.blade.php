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
           {{ Lang::get('lang.checkout') }}
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
	<div class="container">
		<div class="w3ls_w3l_banner_nav_right_grid"><h3 class="text-center">{{ Lang::get('lang.my_cart') }} (<span id="simpleCart_quantity" class="simpleCart_quantity"> 0 </span>)</h3></div>
		<div class="cart-gd">
			<div class="row cart-header new-cart to-clone">
				 <div class="cart-sec simpleCart_shelfItem">
					<div class="col-xs-6 col-md-4 cart-item cyc">
						 <img src="" class="img-responsive item_img checkout_img" alt="">
					</div>
				    <div class="col-xs-6 col-md-4 no-padding cart-item-info">
				    	<div class="col-xs-12">
							<h3><a href="#!" class="item_name"> </a></h3>
							<ul class="qty list-unstyled formulario">
								<li><p>{{ Lang::get('lang.order_qty') }}: <span class="item_qty"></span></p></li>
								<li><p>{{ Lang::get('lang.price_unit') }}: <span class="item_price"></span></p></li>
							</ul>
				    	</div>
						<div class="col-xs-12">
							<strong>Sub-total : <span class="item_sub_total text-success"></span></strong>
							<div class="clearfix"></div>
				        </div>	
				   </div>
			    	<div class="col-xs-12 col-md-4">
			    		<dl class="dl-horizontal">
							<dt>{{ Lang::get('lang.product_size') }}</dt>
						  	<dd class="item_size"><img src="{{ asset('images/loader.gif') }}" class="miniLoader active"></dd>
						  	<dt>{{ Lang::get('lang.product_color') }}</dt>
						  	<dd class="item_color"><img src="{{ asset('images/loader.gif') }}" class="miniLoader active"></dd>
						  	<dt>{{ Lang::get('lang.product_fabric') }}</dt>
						  	<dd class="item_fabric"><img src="{{ asset('images/loader.gif') }}" class="miniLoader active"></dd>
						</dl>
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