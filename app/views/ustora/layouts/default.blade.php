<?php $shopType = ShopType::getShopInfo(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('template/'.$shopType->template.'/css/bootstrap.min.css')}}">
    
    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/4a5a4c64fc.js"></script>
    
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('plugins/side-shopping-cart/css/style.css') }}" type="text/css" media="screen" />

    <link rel="stylesheet" href="{{ asset('plugins/owl-carousel/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{ asset('template/'.$shopType->template.'/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('template/'.$shopType->template.'/css/responsive.css')}}">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="{{ asset('template/'.$shopType->template.'/css/custom.css')}}">
    <!-- Latest jQuery form server -->
    <script src="{{ asset('template/'.$shopType->template.'/js/jquery-1.11.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/simpleCart/simpleCart.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/custom.css')}}">
    <style type="text/css">
		<?php Palet::getPalet(); ?>	
	</style>
  </head>
  <body>
	<input type="hidden" value="{{ URL::to('/') }}" class="baseUrl">
    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="user-menu">
                        <ul>
                        	@if(!Auth::check())
							<li>
								<a href="{{ URL::to('inicio/login') }}">
									<i class="fa fa-user"></i> Login
								</a>
							</li>
							<li>
								<a href="{{ URL::to('inicio/registrese') }}">
									<span class="glyphicon glyphicon-lock"> </span>{{ Lang::get('lang.create_account') }}
								</a>
							</li>	
							@else
							    <li>
							    	<a href="{{ URL::to('tienda/usuario/perfil') }}"><i class="fa fa-pencil"> </i> {{ Lang::get('lang.profile') }}</a>
							    </li>
							    <li>
							    	<a href="{{ URL::to('tienda/mi-lista-de-deseos') }}"><i class="fa fa-heart"> </i> {{ Lang::get('lang.my_wishlist') }}</a>
							    </li>
							    <li>
							    	<a href="{{ URL::to('tienda/usuario/mis-compras') }}"><i class="fa fa-shopping-bag" aria-hidden="true"></i> {{ Lang::get('lang.fact_title') }}</a>
							    </li>
								<li>
									<a href="{{ URL::to('tienda/logout') }}">
										<span class="glyphicon glyphicon-lock"> </span>Logout
									</a>
								</li>		
							@endif
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="header-right">
                        <ul class="list-unstyled list-inline">
                            <li class="dropdown dropdown-small">
                                <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><span class="key">currency :</span><span class="value">USD </span><b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">USD</a></li>
                                    <li><a href="#">INR</a></li>
                                    <li><a href="#">GBP</a></li>
                                </ul>
                            </li>
                            @if($shopType->store_plan > 1)
                            <li class="dropdown dropdown-small">
                                <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#">
                                	<span class="key">
                                		{{ Lang::get('lang.change-lang') }} :
                                	</span>
                                	<span class="value">
                                		@if(!Session::has('lang') || Session::get('lang') == 'es') 
                                			{{ Lang::get('lang.get_spanish') }} 
                                		@else 
                                			{{ Lang::get('lang.get_english') }} 
                                		@endif 
                                	</span>
                                	<b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
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
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End header area -->
    
    <div class="site-branding-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo">
                        <h1>
                            @if($shopType->store_plan > 1)
                                <img src="{{ asset('images/'.ShopType::getLogo()) }}" class="logo">
                            @else
                                {{ $shopType->store_name }}
                            @endif
                        </h1>
                    </div>
                </div>
                @if(Auth::check())
                <div class="col-sm-6">
                    <div class="shopping-item">
                        <a href="#!" id="cd-cart-trigger">
                            Cart - <span class="cart-amunt simpleCart_total">$</span> 
                            <i class="fa fa-shopping-cart"></i> 
                        </a>
                        <span class="product-count simpleCart_quantity">5</span>
                    </div>
                </div>
                @else
                <div class="col-sm-6">
                    <div class="shopping-item">
                        <a href="#!" id="" data-toggle="tooltip" data-placement="top" title="{{ Lang::get('lang.must_log_in') }}">
                            Cart - <span class="cart-amunt">$0.00</span> 
                            <i class="fa fa-shopping-cart"></i> 
                        </a>
                        <span class="product-count">0</span>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div> <!-- End site branding area -->
    
    <div class="mainmenu-area first">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div> 
                <div class="navbar-collapse collapse relative">
                    <ul class="nav navbar-nav pull-right ">
                        <li class="active"><a href="{{ URL::to('/') }}">{{ Lang::get('lang.home_title') }}</a></li>
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

                        <li><a href="{{ URL::to('tienda/checkout') }}">Checkout</a></li>
                        <li><a href="{{ URL::to('tienda/contectenos') }}">{{ Lang::get('lang.menu_contact') }}</a></li>
                        <li>
                            <a href="#search-input" data-toggle="collapse">
                                <i class="fa fa-search second-text"></i>
                            </a>
                        </li>
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
            </div>
        </div>
    </div> <!-- End mainmenu area -->
    
    @yield('content')
    
    <div class="footer-top-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="footer-about-us">
                        <h2>u<span>Stora</span></h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis sunt id doloribus vero quam laborum quas alias dolores blanditiis iusto consequatur, modi aliquid eveniet eligendi iure eaque ipsam iste, pariatur omnis sint! Suscipit, debitis, quisquam. Laborum commodi veritatis magni at?</p>
                        <div class="footer-social">
                            <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">{{ Lang::get('lang.footer_account') }}</h2>
                        <ul>
                            @if(!Auth::check())
                            <li>
                                <a href="{{ URL::to('inicio/login') }}"><span class="glyphicon glyphicon-user"> </span>Login</a>
                            </li>
                            <li>
                                <a href="{{ URL::to('inicio/registrese') }}"><span class="glyphicon glyphicon-lock"> </span>{{ Lang::get('lang.create_account') }}</a>
                            </li>           
                            <li><a href="{{ URL::to('inicio/login') }}"><i class="fa fa-heart"></i> Create wishlist</a></li>
                            <li><a href="{{ URL::to('inicio/login') }}"><i class="fa fa-shopping-bag" aria-hidden="true"></i> my shopping bag</a></li>
                            @else
                            <li><a href="{{ URL::to('inicio/login') }}">{{ Lang::get('lang.my_wishlist') }}</a></li>
                            <li><a href="{{ URL::to('/') }}">brands</a></li>
                            <li><a href="{{ URL::to('tienda/logout') }}">Log out</a></li>
                            @endif
                        </ul>                        
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">{{ Lang::get('lang.footer_shop') }}</h2>
                        <ul>
                            @foreach(GetMenu::getFooterCat() as $f)
                            <li><a href="{{ URL::to('tienda/productos/categoria/'.$c->id) }}">{{ $f->description_es }}</a></li>
                            @endforeach
                        </ul>                        
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-newsletter">
                        <h2 class="footer-wid-title">{{ Lang::get('lang.join_subscriber') }}</h2>
                        <p>Sign up to our newsletter and get exclusive deals you wont find anywhere else straight to your inbox!</p>
                        <div class="newsletter-form">
                            <form action="#">
                                <input type="email" placeholder="{{ Lang::get('lang.subscribe_placeholder') }}">
                                <input type="submit" value="{{ Lang::get('lang.subscribe') }}">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End footer top area -->
    
    <div class="footer-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="copyright">
                        <p>© {{ Lang::get('lang.footer_copy') }}</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="footer-card-icon">
                        <i class="fa fa-cc-discover"></i>
                        <i class="fa fa-cc-mastercard"></i>
                        <i class="fa fa-cc-paypal"></i>
                        <i class="fa fa-cc-visa"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End footer bottom area -->
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
    
    
    <!-- Bootstrap JS form CDN -->
    <script src="{{ asset('template/'.$shopType->template.'/js/bootstrap.min.js')}}"></script>
    
    <!-- jQuery sticky menu -->
    <script src="{{ asset('plugins/owl-carousel/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('template/'.$shopType->template.'/js/jquery.sticky.js') }}"></script>
    
    <!-- jQuery easing -->
    <script src="{{ asset('template/'.$shopType->template.'/js/jquery.easing.1.3.min.js') }}"></script>
    
    <!-- Main Script -->
    <script src="{{ asset('template/'.$shopType->template.'/js/main.js') }}"></script>
    
    <!-- Slider -->
    <script type="text/javascript" src="{{ asset('template/'.$shopType->template.'/js/bxslider.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('template/'.$shopType->template.'/js/script.slider.js') }}"></script>
  	

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
	  	});
	</script>
	@yield('postscript')
</body>
</html>