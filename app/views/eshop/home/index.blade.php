@extends($store->template.'.layouts.default')

@section('content')
<div class="banner">
	<div class="container">
		<div class="banner-bottom">
			<div class="banner-bottom-left">
				<h2>B<br>U<br>Y</h2>
			</div>
			<div class="banner-bottom-right">
				<div  class="callbacks_container">
					<ul class="rslides" id="slider4">
						<li>
							<div class="banner-info">
								<h3>Smart But Casual</h3>
								<p>Start your shopping here...</p>
							</div>
						</li>
						<li>
							<div class="banner-info">
							   <h3>Shop Online</h3>
								<p>Start your shopping here...</p>
							</div>
						</li>
						<li>
							<div class="banner-info">
							  <h3>Pack your Bag</h3>
								<p>Start your shopping here...</p>
							</div>								
						</li>
					</ul>
				</div>
				<!--banner-->
	  			<script src="{{ asset('template/eshop/js/responsiveslides.min.js') }}"></script>
				<script>
				    // You can also use "$(window).load(function() {"
				    $(function () {
				      // Slideshow 4
				      $("#slider4").responsiveSlides({
				        auto: true,
				        pager:true,
				        nav:false,
				        speed: 500,
				        namespace: "callbacks",
				        before: function () {
				          $('.events').append("<li>before event fired.</li>");
				        },
				        after: function () {
				          $('.events').append("<li>after event fired.</li>");
				        }
				      });
				
				    });
				</script>
			</div>
			<div class="clearfix"> </div>
		</div>
		<div class="shop">
			<a href="{{ URL::to('/') }}">SHOP COLLECTION NOW</a>
		</div>
	</div>
</div>
<!-- content-section-starts-here -->
<div class="container">
	<div class="main-content">
		<div class="online-strip">
			<div class="col-md-4 follow-us">
				<h3>{{ Lang::get('lang.follow') }} : <a class="twitter" href="#"></a><a class="facebook" href="#"></a></h3>
			</div>
			<div class="col-md-4 shipping-grid">
				<div class="shipping">
					<img src="{{ asset('template/eshop/images/shipping.png') }}" alt="" />
				</div>
				<div class="shipping-text">
					<h3>Free Shipping</h3>
					<p>on orders over $ 199</p>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="col-md-4 online-order">
				<p>{{ Lang::get('lang.order') }}</p>
				<h3>Tel:999 4567 8902</h3>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="products-grid row">
			<header class="col-xs-12">
				<h3 class="head text-center">{{ Lang::get('lang.latest') }}</h3>
			</header>
			@foreach($items as $i)
			<div class="col-md-4 product text-center">
				<div class="item-image">
					<a href="{{ URL::to('tienda/ver-producto/'.$i->id) }}">
						@if(strpos($i->imagenes[0]->image,'lorempixel.com'))
							<img src="{{ $i->imagenes[0]->image }}" alt="" />
						@else
							<img src="{{ asset('images/items/'.$i->imagenes[0]->image) }}" alt="" />
						@endif
					</a>
					<div class="mask">
						<a href="{{ URL::to('tienda/ver-producto/'.$i->id) }}">{{ Lang::get('lang.see_product') }}</a>
					</div>
				</div>
				<div class="item-text">
					<a class="product_name" href="{{ URL::to('tienda/ver-producto/'.$i->id) }}">
						@if(!Session::has('lang') || Session::get('lang') == 'es')
							{{ $i->title_es }}
						@else
							{{ $i->title_eng }}
						@endif
					</a>
				</div>
				<p>
					<a class="item_add" href="#">
						<span class="item_price">
							@if($i->offertItem->first())
								<strong>${{ $i->price - $i->price*$i->offertItem->first()['offerts']['percent']/100 }}</strong>
								<br>
								<small><del>${{ $i->price }}</del></small>
							@else
								${{ $i->price }}
							@endif
						</span>
					</a>
				</p>
			</div>
			@endforeach
			<div class="clearfix"></div>
		</div>
	</div>
</div>
{{ View::make('partials.brands-slide')->with('brands',$brands); }}
<div class="other-products">
	<div class="container">
		<h3 class="like text-center">{{ Lang::get('lang.featured') }}</h3>        			
	    <ul id="flexiselDemo3">
			<li><a href="single.html"><img src="{{ asset('template/eshop/images/l1.jpg') }}" class="img-responsive" alt="" /></a>
				<div class="product liked-product simpleCart_shelfItem">
				<a class="like_name" href="single.html">perfectly simple</a>
				<p><a class="item_add" href="#"><i></i> <span class=" item_price">$759</span></a></p>
				</div>
			</li>
			<li><a href="single.html"><img src="{{ asset('template/eshop/images/l2.jpg') }}" class="img-responsive" alt="" /></a>						
				<div class="product liked-product simpleCart_shelfItem">
				<a class="like_name" href="single.html">praising pain</a>
				<p><a class="item_add" href="#"><i></i> <span class=" item_price">$699</span></a></p>
				</div>
			</li>
			<li><a href="single.html"><img src="{{ asset('template/eshop/images/l3.jpg') }}" class="img-responsive" alt="" /></a>
				<div class="product liked-product simpleCart_shelfItem">
				<a class="like_name" href="single.html">Neque porro</a>
				<p><a class="item_add" href="#"><i></i> <span class=" item_price">$329</span></a></p>
				</div>
			</li>
			<li><a href="single.html"><img src="{{ asset('template/eshop/images/l4.jpg') }}" class="img-responsive" alt="" /></a>
				<div class="product liked-product simpleCart_shelfItem">
				<a class="like_name" href="single.html">equal blame</a>
				<p><a class="item_add" href="#"><i></i> <span class=" item_price">$499</span></a></p>
				</div>
			</li>
			<li><a href="single.html"><img src="{{ asset('template/eshop/images/l5.jpg') }}" class="img-responsive" alt="" /></a>
				<div class="product liked-product simpleCart_shelfItem">
				<a class="like_name" href="single.html">perfectly simple</a>
				<p><a class="item_add" href="#"><i></i> <span class=" item_price">$649</span></a></p>
				</div>
			</li>
	     </ul>
	    <script type="text/javascript">
		 $(window).load(function() {
			$("#flexiselDemo3").flexisel({
				visibleItems: 4,
				animationSpeed: 1000,
				autoPlay: true,
				autoPlaySpeed: 3000,    		
				pauseOnHover: true,
				enableResponsiveBreakpoints: true,
		    	responsiveBreakpoints: { 
		    		portrait: { 
		    			changePoint:480,
		    			visibleItems: 1
		    		}, 
		    		landscape: { 
		    			changePoint:640,
		    			visibleItems: 2
		    		},
		    		tablet: { 
		    			changePoint:768,
		    			visibleItems: 3
		    		}
		    	}
		    });
		    
		});
	   </script>
	   <script type="text/javascript" src="{{ asset('template/eshop/js/jquery.flexisel.js') }}"></script>
   </div>
</div>
		<!-- content-section-ends-here -->
@stop