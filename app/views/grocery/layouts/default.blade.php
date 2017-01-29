<?php $shopType = ShopType::getShopInfo(); ?>
<!DOCTYPE html>
<html>
<head>
<title>{{ $title }}</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Grocery Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="{{ asset('template/'.$shopType->template.'/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />
<link href="{{ asset('template/'.$shopType->template.'/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
<!-- font-awesome icons -->
<script src="https://use.fontawesome.com/4a5a4c64fc.js"></script>

<!-- //font-awesome icons -->
<!-- js -->
<script src="{{ asset('template/'.$shopType->template.'/js/jquery-1.11.1.min.js')}}"></script>
<!-- //js -->
<link href='//fonts.googleapis.com/css?family=Ubuntu:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="{{ asset('template/'.$shopType->template.'/js/move-top.js') }}"></script>
<script type="text/javascript" src="{{ asset('template/'.$shopType->template.'/js/easing.js') }}"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<link rel="stylesheet" href="{{ asset('plugins/side-shopping-cart/css/style.css') }}" type="text/css" media="screen" />
<link rel="stylesheet" href="{{ asset('plugins/owl-carousel/css/owl.carousel.css')}}">


<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('plugins/simpleCart/simpleCart.js') }}"> </script>

<link rel="stylesheet" type="text/css" href="{{ asset('template/'.$shopType->template.'/css/custom.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">

<style type="text/css">
	<?php Palet::getPalet(); ?>
</style>
<!-- start-smoth-scrolling -->
</head>
	
<body>
	<input type="hidden" value="{{ URL::to('/') }}" class="baseUrl">
	<div class="agileits_header first">
		<div class="w3l_search">
			<form action="{{ URL::to('tienda/productos/busqueda') }}" method="GET">
				<input type="text" name="busq" value="{{ Lang::get('lang.search_placeholder') }}..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '{{ Lang::get('lang.search_placeholder') }}...';}" required="">
				<input type="submit" value=" " class="third">
			</form>
		</div>
		@if(Auth::check())
		<div class="product_list_header valign">  
            <fieldset>
                <input type="submit" name="submit" value="{{ Lang::get('lang.cart') }}" id="cd-cart-trigger" class="button" />
            </fieldset>
		</div>
		@else
		<div class="product_list_header valign">  
            <fieldset>
                <input type="submit" name="submit" value="{{ Lang::get('lang.cart') }}" class="button" data-toggle="tooltip" data-placement="bottom" data-title="{{ Lang::get('lang.must_log_in') }}"/>
            </fieldset>
		</div>
		@endif
		<div class="w3l_header_right valign">
			<ul class="menu-list">
				@if(!Auth::check())
					<li>
						<a href="{{ URL::to('inicio/login') }}">
							<span class="glyphicon glyphicon-user"> </span>Login
						</a>
					</li>
					<li>
						<a href="{{ URL::to('inicio/login') }}">
							<span class="glyphicon glyphicon-lock"> </span>{{ Lang::get('lang.create_account') }}
						</a>
					</li>
				@else
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->name.' '.Auth::user()->lastname }} <span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a href="{{ URL::to('tienda/usuario/perfil') }}">
								<i class="fa fa-pencil"> </i> {{ Lang::get('lang.profile') }}
							</a>
						</li>
					    <li>
					    	<a href="{{ URL::to('tienda/mi-lista-de-deseos') }}"><i class="fa fa-heart"> </i> {{ Lang::get('lang.my_wishlist') }}</a></li>
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
		<div class="w3l_header_right1 third">
			<h2><a href="{{ URL::to('tienda/contectenos') }}">{{ Lang::get('lang.menu_contact') }}</a></h2>
		</div>
		<div class="clearfix"> </div>
	</div>
	<!-- script-for sticky-nav -->
	<script>
	$(document).ready(function() {
		 var navoffeset=$(".agileits_header").offset().top;
		 $(window).scroll(function(){
			var scrollpos=$(window).scrollTop(); 
			if(scrollpos >=navoffeset){
				$(".agileits_header").addClass("fixed");
			}else{
				$(".agileits_header").removeClass("fixed");
			}
		 });
		 
	});
	</script>
	<!-- //script-for sticky-nav -->
	<div class="logo_products">
		<div class="container">
			<div class="w3ls_logo_products_left">
				<h1>
					@if($shopType->store_plan > 1)
						<img src="{{ asset('images/'.ShopType::getLogo()) }}" class="logo">
					@else
						{{ $shopType->store_name }}
					@endif
				</h1>
			</div>
			<div class="w3ls_logo_products_left1">
				<ul class="special_items">
					<li><a href="about.html">About Us</a><i>/</i></li>
					@foreach(GetMenu::getMenuCat() as $c)
				        <li class="dropdown">
				            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
				            	@if(!Session::has('lang') || Session::get('lang') == 'es') 
				            		{{ $c->description_es }}
				            	@else
				            		{{ $c->description_eng }}
				            	@endif
				            	<b class="caret"></b>
				            	<i>/</i>
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
					            </div>
				            </ul>
				        </li>
				        @endforeach
				</ul>
			</div>
			<div class="w3ls_logo_products_left1">
				<ul class="phone_email">
					<li><i class="fa fa-phone" aria-hidden="true"></i>(+0123) 234 567</li>
					<li><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mailto:store@grocery.com">store@grocery.com</a></li>
				</ul>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<!-- //header -->
	
	@yield('content')
	<!-- newsletter -->
	<div class="newsletter second">
		<div class="container">
			<div class="w3agile_newsletter_left">
				<h3>{{ Lang::get('lang.join_subscriber') }}</h3>
			</div>
			<div class="w3agile_newsletter_right">
				<form action="#" method="post">
					<input type="email" name="Email" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" placeholder="{{ Lang::get('lang.subscribe_placeholder') }}" required="">
					<input type="submit" value="{{ Lang::get('lang.subscribe') }}" class="third">
				</form>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
<!-- //newsletter -->
<!-- footer -->
	<div class="footer">
		<div class="container">
			<div class="col-md-3 w3_footer_grid">
				<h3>{{ Lang::get('lang.footer_account') }}</h3>
				<ul class="w3_footer_grid_list">
					@if(!Auth::check())
						<li>
							<a href="{{ URL::to('inicio/login') }}"><span class="glyphicon glyphicon-user"> </span>Login</a>
						</li>
						<li>
							<a href="{{ URL::to('inicio/registrese') }}"><span class="glyphicon glyphicon-lock"> </span>{{ Lang::get('lang.create_account') }}</a>
						</li>			
					@else
						<li>
							<a href="{{ URL::to('tienda/usuario/perfil') }}">
								<i class="fa fa-pencil"> </i> {{ Lang::get('lang.profile') }}
							</a>
						</li>
					    <li>
					    	<a href="{{ URL::to('tienda/mi-lista-de-deseos') }}">
					    		<i class="fa fa-heart"> </i> {{ Lang::get('lang.my_wishlist') }}
					    	</a>
					    </li>
					    <li>
					    	<a href="{{ URL::to('tienda/usuario/mis-compras') }}">
					    		<i class="fa fa-shopping-bag" aria-hidden="true"></i> {{ Lang::get('lang.fact_title') }}
					    	</a>
					    </li>
						<li><a href="{{ URL::to('tienda/logout') }}">Log out</a></li>
					@endif
				</ul>
			</div>
			<div class="col-md-3 w3_footer_grid">
				<h3>policy info</h3>
				<ul class="w3_footer_grid_list">
					<li><a href="faqs.html">FAQ</a></li>
					<li><a href="privacy.html">privacy policy</a></li>
					<li><a href="privacy.html">terms of use</a></li>
				</ul>
			</div>
			<div class="col-md-3 w3_footer_grid">
				<h3>what in stores</h3>
				<ul class="w3_footer_grid_list">
					@foreach(GetMenu::getFooterCat() as $f)
					<li><a href="{{ URL::to('tienda/productos/categoria/'.$c->id) }}">{{ $f->description_es }}</a></li>
					@endforeach
				</ul>
			</div>
			<div class="col-md-3 w3_footer_grid">
				<h3>twitter posts</h3>
				<ul class="w3_footer_grid_list1">
					<li><label class="fa fa-twitter" aria-hidden="true"></label><i>01 day ago</i><span>Non numquam <a href="#">http://sd.ds/13jklf#</a>
						eius modi tempora incidunt ut labore et
						<a href="#">http://sd.ds/1389kjklf#</a>quo nulla.</span></li>
					<li><label class="fa fa-twitter" aria-hidden="true"></label><i>02 day ago</i><span>Con numquam <a href="#">http://fd.uf/56hfg#</a>
						eius modi tempora incidunt ut labore et
						<a href="#">http://fd.uf/56hfg#</a>quo nulla.</span></li>
				</ul>
			</div>
			<div class="clearfix"> </div>
			<div class="agile_footer_grids">
				<div class="col-md-3 w3_footer_grid agile_footer_grids_w3_footer">
					<div class="w3_footer_grid_bottom">
						<h4>100% secure payments</h4>
						<img src="{{ asset('template/'.$shopType.'/images/card.png') }}" alt=" " class="img-responsive" />
					</div>
				</div>
				<div class="col-md-3 w3_footer_grid agile_footer_grids_w3_footer">
					<div class="w3_footer_grid_bottom">
						<h5>connect with us</h5>
						<ul class="agileits_social_icons">
							<li><a href="#" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
							<li><a href="#" class="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							<li><a href="#" class="google"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
							<li><a href="#" class="instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
							<li><a href="#" class="dribbble"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="wthree_footer_copy">
				<p>© {{ Lang::get('lang.footer_copy') }}</p>
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
<!-- //footer -->
<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('template/'.$shopType->template.'/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('plugins/owl-carousel/js/owl.carousel.min.js') }}"></script>


<script>
$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');       
        }
    );
});
</script>
<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
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
	<script type="text/javascript" src="{{ asset('plugins/side-shopping-cart/js/main.js') }}"></script>
	<script>
	  	jQuery(document).ready(function($) {
	  		$('[data-toggle="tooltip"]').tooltip();
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
	  	});
	</script>
	@yield('postscript')
</body>
</html>