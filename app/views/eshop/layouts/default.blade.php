<?php $shopType = ShopType::getShopInfo(); ?>
<!DOCTYPE html>
<html>
<head>
<title>{{ $title }}</title>
<link href="{{ asset('template/eshop/css/bootstrap.css') }}" rel='stylesheet' type='text/css' />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('template/eshop/js/jquery.min.js') }}"></script>
<!-- Custom Theme files -->
<link href="{{ asset('template/eshop/css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Eshop Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--webfont-->
<!-- for bootstrap working -->
	<script type="text/javascript" src="{{ asset('template/eshop/js/bootstrap-3.1.1.min.js') }}"></script>
<!-- //for bootstrap working -->
<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>

<!-- cart -->
<script src="{{ asset('plugins/simpleCart/simpleCart.js') }}"> </script>
<!-- cart -->
<link rel="stylesheet" href="{{ asset('plugins/side-shopping-cart/css/style.css') }}" type="text/css" media="screen" />

<script src="https://use.fontawesome.com/4a5a4c64fc.js"></script>
<link rel="stylesheet" href="{{ asset('plugins/owl-carousel/css/owl.carousel.css')}}">

<!--<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">-->

<link rel="stylesheet" href="{{ asset('template/eshop/css/flexslider.css') }}" type="text/css" media="screen" />
<link rel="stylesheet" href="{{ asset('template/eshop/css/custom.css') }}" type="text/css" media="screen" />

<link rel="stylesheet" href="{{ asset('css/custom.css') }}" type="text/css" media="screen" />
<style type="text/css">
	<?php Palet::getPalet(); ?>	
</style>

</head>
<body>
	<input type="hidden" value="{{ URL::to('/') }}" class="baseUrl">
	<!-- header-section-starts -->
	<div class="header">
		<div class="header-top-strip first">
			<div class="container text-right">
				<div class="header-top-left valign">
					<ul>
						@if(!Auth::check())
						<li>
							<a href="{{ URL::to('inicio/login') }}">
								<span class="glyphicon glyphicon-user"> </span>Login
							</a>
						</li>
						<li>
							<a href="{{ URL::to('inicio/registrese') }}">
								<span class="glyphicon glyphicon-lock"> </span>{{ Lang::get('lang.create_account') }}
							</a>
						</li>	
						@else
							<li class="dropdown">
								  <a href="#!" class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
								    	<span class="glyphicon glyphicon-user"> </span> {{ Auth::user()->name.' '.Auth::user()->lastname }}
								    <span class="caret"></span>
								  </a>
								  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
								    <li><a href="{{ URL::to('tienda/usuario/perfil') }}"><i class="fa fa-pencil"> </i> {{ Lang::get('lang.profile') }}</a></li>
								    <li><a href="{{ URL::to('tienda/mi-lista-de-deseos') }}"><i class="fa fa-heart"> </i> {{ Lang::get('lang.my_wishlist') }}</a></li>
								    <li><a href="{{ URL::to('tienda/usuario/mis-compras') }}"><i class="fa fa-shopping-bag" aria-hidden="true"></i> {{ Lang::get('lang.fact_title') }}</a></li>
								  </ul>
							</li>
							<li>
								<a href="{{ URL::to('tienda/logout') }}">
									<span class="glyphicon glyphicon-lock"> </span>Logout
								</a>
							</li>		
						@endif
					</ul>
				</div>
				<div class="header-right valign">
					@if(Auth::check() && Auth::user()->role_id != 3)
						<div class="cart box_1">
							<a href="#!">
								<h3> 
										<span class="simpleCart_total"> $0.00 </span> 
										(<span id="simpleCart_quantity" class="simpleCart_quantity"> 0 </span>)
								</h3>	
							</a>
							<p><a href="javascript:;" class="simpleCart_empty">{{ Lang::get('lang.empty_car') }}</a></p>
							<div class="clearfix"> </div>
						</div>
						<header>
							<div id="cd-cart-trigger"><a class="cd-img-replace" href="#0">Cart</a></div>
						</header>
					@endif
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!-- header-section-ends -->
	<div class="banner-top">
		<div class="container">
			<nav class="navbar navbar-default" role="navigation">
			    <div class="navbar-header">
			        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
			        </button>
					<div class="logo">
						<h1>
							<a href="{{ URL::to('/') }}">
								@if($shopType->store_plan > 1)
									<img src="{{ asset('images/'.ShopType::getLogo()) }}" class="logo">
								@else
									{{ $shopType->store_name }}
								@endif
							</a>
						</h1>
					</div>
			    </div>
			    <!--/.navbar-header-->
	
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			        <ul class="nav navbar-nav">
						<li><a href="{{ URL::to('/') }}">{{ Lang::get('lang.home_title') }}</a></li>
						@foreach(GetMenu::getMenuCat() as $c)
				        <li class="dropdown">
				            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
				            	@if(!Session::has('lang') || Session::get('lang') == 'es') 
				            		{{ $c->description_es }}
				            	@else
				            		{{ $c->description_eng }}
				            	@endif
				            	<b class="caret"></b>
				            </a>
				            <ul class="dropdown-menu multi-column columns-2">
					            <div class="row">
						            <div class="col-sm-4">
							            <ul class="multi-column-dropdown">
											<h6>
												<a href="{{ URL::to('tienda/productos/categoria/'.$c->id) }}">
												@if(!Session::has('lang') || Session::get('lang') == 'es') 
								            		{{ $c->description_es }}
								            	@else
								            		{{ $c->description_eng }}
								            	@endif
												</a>
											</h6>
											@foreach($c->subcat as $sc)
								            <li>
								            	<a href="{{ URL::to('tienda/productos/subcategoria/'.$sc->id) }}">
								        	  		@if(!Session::has('lang') || Session::get('lang') == 'es') 
									            		{{ $sc->description_es }}
									            	@else
									            		{{ $sc->description_eng }}
									            	@endif
								        	    </a>
								        	</li>
								            @endforeach
								            
							            </ul>
						            </div>
									<div class="clearfix"></div>
					            </div>
				            </ul>
				        </li>
				        @endforeach
						<li><a href="{{ URL::to('inicio/contectenos') }}">{{ Lang::get('lang.menu_contact') }}</a></li>
				        <li><a href="#search-input" data-toggle="collapse"><i class="fa fa-search fa-2x second-text"></i></a></li>
			        </ul>
				    <div class="collapse" id="search-input">
				    	<form method="GET" action="{{ URL::to('tienda/productos/busqueda') }}" class="form-search">
				    	<div class="input-group">
				    		<input type="text" class="form-control busq" placeholder="{{ Lang::get('lang.search_placeholder') }}" name="busq">
				    		<div class="input-group-addon btn-search third"><i class="fa fa-search"></i></div>
				    	</div>
				    	</form>
				    </div>
			    </div>
			    <!--/.navbar-collapse-->
			</nav>
			<!--/.navbar-->
		</div>
	</div>
	@yield('content')
	<div class="news-letter second">
		<div class="container">
			<div class="join">
				<h6>{{ Lang::get('lang.join_subscriber') }}</h6>
				<div class="sub-left-right">
					<form>
						<input type="text" placeholder="{{ Lang::get('lang.subscribe_placeholder') }}"/>
						<input type="submit" value="{{ Lang::get('lang.subscribe') }}" class="first"/>
					</form>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<div id="cd-shadow-layer"></div>
	<div id="cd-cart">
		<h2>{{ Lang::get('lang.cart') }}</h2>
		<ul class="cd-cart-items">
			<div class="simpleCart_items"></div>
		</ul> <!-- cd-cart-items -->

		<div class="cd-cart-total">
			<p>Total <span class="simpleCart_total"></span></p>
		</div> <!-- cd-cart-total -->

		<a href="{{ URL::to('tienda/checkout') }}" data-target="_blank" class="checkout-btn">{{ Lang::get('lang.go_my_cart') }}</a>
		
	</div> <!-- cd-cart -->
	<div class="footer">
		<div class="container">
		 <div class="footer_top">
			<div class="span_of_4">
				<div class="col-md-3 span1_of_4">
					<h4>{{ Lang::get('lang.footer_shop') }}</h4>
					<ul class="f_nav">
						@foreach(GetMenu::getFooterCat() as $f)
						<li><a href="{{ URL::to('tienda/productos/categoria/'.$c->id) }}">{{ $f->description_es }}</a></li>
						@endforeach
					</ul>	
				</div>
				<div class="col-md-3 span1_of_4">
					<h4>{{ Lang::get('lang.footer_help') }}</h4>
					<ul class="f_nav">
						<li><a href="#">frequently asked  questions</a></li>
						<li><a href="#">men</a></li>
						<li><a href="#">women</a></li>
						<li><a href="#">accessories</a></li>
						<li><a href="#">kids</a></li>
						<li><a href="#">brands</a></li>
					</ul>	
				</div>
				<div class="col-md-3 span1_of_4">
					<h4>{{ Lang::get('lang.footer_account') }}</h4>
					<ul class="f_nav">
						@if(!Auth::check())
						<li>
							<a href="{{ URL::to('inicio/login') }}"><span class="glyphicon glyphicon-user"> </span>Login</a>
						</li>
						<li>
							<a href="{{ URL::to('inicio/registrese') }}"><span class="glyphicon glyphicon-lock"> </span>{{ Lang::get('lang.create_account') }}</a>
						</li>			
						<li><a href="{{ URL::to('inicio/login') }}">create wishlist</a></li>
						<li><a href="{{ URL::to('inicio/login') }}">my shopping bag</a></li>
						<li><a href="{{ URL::to('inicio/login') }}">brands</a></li>
						@else
						<li><a href="{{ URL::to('inicio/login') }}">{{ Lang::get('lang.my_wishlist') }}</a></li>
						<li><a href="{{ URL::to('/') }}">brands</a></li>
						<li><a href="{{ URL::to('tienda/logout') }}">Log out</a></li>
						@endif
					</ul>				
				</div>
				<div class="col-md-3 span1_of_4">
					<h4>{{ Lang::get('lang.footer_popular') }}</h4>
					<ul class="f_nav">
						<li><a href="#">new arrivals</a></li>
						<li><a href="#">men</a></li>
						<li><a href="#">women</a></li>
						<li><a href="#">accessories</a></li>
						<li><a href="#">kids</a></li>
						<li><a href="#">brands</a></li>
						<li><a href="#">trends</a></li>
						<li><a href="#">sale</a></li>
						<li><a href="#">style videos</a></li>
						<li><a href="#">login</a></li>
						<li><a href="#">brands</a></li>
					</ul>			
				</div>
				<div class="clearfix"></div>
				</div>
		  </div>
		  <div class="cards text-center">
				<img src="{{ asset('template/eshop/images/cards.jpg') }}" alt="" />
		  </div>
		  <div class="copyright text-center">
				<p>© {{ Lang::get('lang.footer_copy') }}</p>
		  </div>
		</div>
		@if($shopType->store_plan > 1)
		<div class="btn-group dropup change-lang">
		  	<button type="button" class="btn third">{{ Lang::get('lang.change-lang') }}</button>
		  	<button type="button" class="btn dropdown-toggle third" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    <span class="caret"></span>
			    <span class="sr-only">Toggle Dropdown</span>
		  	</button>
		  	<ul class="dropdown-menu third">
			     @if(!Session::has('lang') || Session::get('lang') == 'es')
			    	<li class="active">
			    		<a href="#!">
			    			{{ Lang::get('lang.get_spanish') }}
			    		</a>
			    	</li>
			    @else
			    	<li>
			    		<a href="{{ URL::to('tienda/cambiar-lenguaje/spanish') }}">
			    			{{ Lang::get('lang.get_spanish') }}
			    		</a>
			    	</li>
			    @endif
			    @if(Session::has('lang') && Session::get('lang') == 'eng')
			    	<li  class="active">
			    		<a href="#!">
			    			{{ Lang::get('lang.get_english') }}
			    		</a>
			    	</li>
			    @else
			    	<li>
			    		<a href="{{ URL::to('tienda/cambiar-lenguaje/english') }}">
			    			{{ Lang::get('lang.get_english') }}
			    		</a>
			    	</li>
			    @endif

		  	</ul>
		</div>
		@endif
	</div>
	<script src="{{ asset('plugins/owl-carousel/js/owl.carousel.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('template/eshop/js/custom.js') }}"></script>
	<script type="text/javascript" src="{{ asset('plugins/side-shopping-cart/js/main.js') }}"></script>

	<script>
	  	jQuery(document).ready(function($) {
	  		console.log(getRootUrl());
	  		simpleCart({
    			checkout: {
			    	type: "SendForm",
			    	url : getRootUrl()+'/tienda/checkout/procesar',
			    	email: "emails@email.com"
			    },
			    cartColumns: [
			    	{ attr: "name", label: "Name" },
					{ attr: "price", label: "Price", view: 'currency' },
					{ view: "decrement", label: false, text: '<i class="fa fa-minus-circle text-danger" aria-hidden="true"></i>' },
					{ attr: "quantity", label: "Qty" },
					{ view: "increment", label: false, text: '<i class="fa fa-plus-circle text-success" aria-hidden="true"></i>' },
					{ attr: "total", label: "SubTotal", view: 'currency' },
					{ view: "remove", text: '<i class="fa fa-times-circle text-danger" aria-hidden="true"></i>', label: false }
			    ],
			    data: {},
  			});
  			$('.btn-search').on('click', function(event) {
  				$('.form-search').submit();
  			});
  			$('.brand-list').owlCarousel({
		        loop:true,
		        nav:true,
		        margin:20,
		        responsiveClass:true,
		        responsive:{
		            0:{
		                items:1,
		            },
		            600:{
		                items:3,
		            },
		            1000:{
		                items:4,
		            }
		        }
		    });   
	  	});
	</script>
	@yield('postscript')
</body>
</html>