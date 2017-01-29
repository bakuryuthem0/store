@extends($store->template.'.layouts.default')

@section('content')
<!-- banner -->
	<div class="banner">
		<div class="main-slider w3l_banner_nav_right">
			<section class="slider">
				<div class="flexslider">
					<ul class="slides">
						<li>
							<img src="{{ asset('template/'.ShopType::getShopInfo()->template.'/images/1.jpg') }}">
							<div class="banner-text col-xs-12 col-md-4">
								<div class="banner-text-valigned">
									<h3>Make your <span>food</span> with Spicy.</h3>
									<br>
									<div class="more third">
										<a href="products.html" class="button--saqui button--round-l button--text-thick" data-text="Shop now">Shop now</a>
									</div>
								</div>
							</div>
						</li>
						<li>
							<img src="{{ asset('template/'.ShopType::getShopInfo()->template.'/images/2.jpg') }}">
							<div class="banner-text col-xs-12 col-md-4">
								<div class="banner-text-valigned">
									<h3>Make your <span>food</span> with Spicy.</h3>
									<br>
									<div class="more third">
										<a href="products.html" class="button--saqui button--round-l button--text-thick" data-text="Shop now">Shop now</a>
									</div>
								</div>
							</div>
						</li>
						<li>
							<img src="{{ asset('template/'.ShopType::getShopInfo()->template.'/images/3.jpg') }}">
							<div class="banner-text col-xs-12 col-md-4">
								<div class="banner-text-valigned">
									<h3>upto <i>50%</i> off.</h3>
									<br>
									<div class="more third">
										<a href="products.html" class="button--saqui button--round-l button--text-thick" data-text="Shop now">Shop now</a>
									</div>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</section>
		</div>
		<div class="clearfix"></div>
	</div>
<!-- banner -->
	
<!-- top-brands -->
	<div class="top-brands">
		<div class="container">
			<h3>{{ Lang::get('lang.latest') }}</h3>
			<div class="agile_top_brands_grids">
				@foreach($items as $i)
				<div class="col-md-4 top_brand_left">
					<div class="hover14 column">
						<div class="agile_top_brand_left_grid">
							<div class="item-image">
								<div class="tag">
									@if(strpos($i->imagenes[0]->image,'lorempixel.com'))
										<img src="{{ $i->imagenes[0]->image }}" alt="" class="img-responsive" />
									@else
										<img src="{{ asset('images/items/'.$i->imagenes[0]->image) }}" alt="" class="img-responsive" />
									@endif
								</div>
							</div>
							<div class="agile_top_brand_left_grid1">
								<figure>
									<div class="snipcart-item block" >
										<div class="snipcart-thumb">
											<p>
												@if(!Session::has('lang') || Session::get('lang') == 'es')
													{{ $i->title_es }}
												@else
													{{ $i->title_eng }}
												@endif
											</p>
											<h4>
												@if($i->offertItem->first())
													<strong>${{ $i->price - $i->price*$i->offertItem->first()['offerts']['percent']/100 }}</strong>
													<br>
													<small><del>${{ $i->price }}</del></small>
												@else
													${{ $i->price }}
												@endif
											</h4>
										</div>
										<div class="snipcart-details top_brand_home_details">
											<a href="{{ URL::to('tienda/ver-producto/'.$i->id) }}" class="btn button third">
												{{ Lang::get('lang.see_details') }}
											</a>
										</div>
									</div>
								</figure>
							</div>
						</div>
					</div>
				</div>
				@endforeach
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!-- //top-brands -->
	{{ View::make('partials.brands-slide')->with('brands',$brands); }}

	<!-- fresh-vegetables -->
	<div class="fresh-vegetables">
		<div class="container">
			<h3>{{ Lang::get('lang.featured') }}</h3>
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
		</div>
	</div>
	<!-- //fresh-vegetables -->
@stop

@section('postscript')

<!-- flexSlider -->
<link rel="stylesheet" href="{{ asset('template/'.ShopType::getShopInfo()->template.'/css/flexslider.css')}}" type="text/css" media="screen" property="" />


<script defer src="{{ asset('template/'.ShopType::getShopInfo()->template.'/js/jquery.flexslider.js') }}"></script>
<script type="text/javascript" src="{{ asset('template/'.ShopType::getShopInfo()->template.'/js/jquery.flexisel.js') }}"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
	$('.flexslider').flexslider({
		animation: "slide"
  	});
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
<!-- //flexSlider -->
@stop