@extends($store->template.'.layouts.default')
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
					@if(!Session::has('lang') || Session::get('lang') == 'es')
						{{ $item->title_es }}
					@else
						{{ $item->title_eng }}
					@endif
				</li>
			</ul>
			<ul class="col-xs-6 col-md-3 previous pull-right text-right">
			    <li><a href="{{ URL::previous() }}">{{ Lang::get('lang.get_back') }}</a></li>
		  	</ul>
		</div>
	</div>
<!-- //products-breadcrumb -->
<!-- banner -->
	<div class="simpleCart_shelfItem">
		{{ $sideBar }}
		<div class="w3l_banner_nav_right margin-top-1">
			<div class="agileinfo_single no-padding-top">
				<h5 class="item_name">
					@if(!Session::has('lang') || Session::get('lang') == 'es')
						{{ $item->title_es }}
					@else
						{{ $item->title_eng }}
					@endif
				</h5>
				<div class="col-md-5 zoom-grid">
					<div class="flexslider">
						<ul class="slides">
							<img src="{{ asset('images/items/'.$item->imagenes->first()->image) }}" class="img-responsive item_img hidden" alt="" />
							@foreach($item->imagenes as $img)
								@if(strpos($img->image,'lorempixel.com'))
									<li class="" data-thumb="{{ $img->image }}">
										<div class="thumb-image"> <img src="{{ $img->image }}" data-imagezoom="true" class="img-responsive " alt="" /> </div>
									</li>
								@else
									<li class="" data-thumb="{{ asset('images/items/'.$img->image) }}">
										<div class="thumb-image"> <img src="{{ asset('images/items/'.$img->image) }}" data-imagezoom="true" class="img-responsive " alt="" /> </div>
									</li>
								@endif
							@endforeach
						</ul>
					</div>
				</div>
				<div class="col-md-7 agileinfo_single_right">
					<div class="rating1">
						<span class="starRating">
							<input id="rating5" type="radio" name="rating" value="5">
							<label for="rating5">5</label>
							<input id="rating4" type="radio" name="rating" value="4">
							<label for="rating4">4</label>
							<input id="rating3" type="radio" name="rating" value="3" checked>
							<label for="rating3">3</label>
							<input id="rating2" type="radio" name="rating" value="2">
							<label for="rating2">2</label>
							<input id="rating1" type="radio" name="rating" value="1">
							<label for="rating1">1</label>
						</span>
					</div>
					<div class="w3agile_description">
						<h4>Description :</h4>
						<div class="text-justify">
							@if(!Session::has('lang') || Session::get('lang') == "es")
								{{ $item->description_es }}
							@else
								{{ $item->description_eng }}
							@endif
						</div>
					</div>
					<div class="col-md-12 dress-info">
						<div class="col-xs-12 formulario no-padding">
							<div class="col-xs-12 col-md-6 no-padding text-left">{{ Lang::get('lang.product_fabric') }}</div>
							<div class="col-xs-12 col-md-6 no-padding text-right">
								<select class="btn btn-default item-details form-control item_fabric">
									@foreach($item->materiales as $m)
									<option value="{{ $m->id }}">
											@if(!Session::has('lang') || Session::get('lang') == 'es') 
												{{ $m->description_es }}
											@else
												{{ $m->description_eng }}
											@endif
									</option>
									@endforeach
								</select>	
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="col-xs-12 formulario no-padding">
							<div class="col-xs-12 col-md-6 no-padding text-left">{{ Lang::get('lang.product_color') }}</div>
							<div class="col-xs-12 col-md-6 no-padding text-right">
								<select class="btn btn-default item-details form-control item_color">
								  	@foreach($item->colores as $c)
									<option value="{{ $c->id }}">
											@if(!Session::has('lang') || Session::get('lang') == 'es') 
												{{ $c->description_es }}
											@else
												{{ $c->description_eng }}
											@endif
									</option>
									@endforeach
								</select>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="col-xs-12 formulario no-padding">
							<div class="col-xs-12 col-md-6 no-padding text-left">{{ Lang::get('lang.product_size') }}</div>
							<div class="col-xs-12 col-md-6 no-padding text-right">
								<select class="btn btn-default item-details form-control item_size">
									@foreach($item->tallas as $t)
							    	<option value="{{ $t->id }}">
										@if(!Session::has('lang') || Session::get('lang') == 'es') 
											{{ $t->description_es }}
										@else
											{{ $t->description_eng }}
										@endif
							    	</option>
									@endforeach
								</select>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="purchase">
							<div class="snipcart-thumb agileinfo_single_right_snipcart">
								<h4 class="">{{ Lang::get('lang.price_unit') }} : <label class="text-success item_price">${{ $item->price }}</label></h4>
							</div>
							@if(Auth::check() && Auth::user()->role_id != 3)
								<button class="item_add btn btn-default">{{ Lang::get('lang.add_to_cart') }}</button>
							@else
								<button class="btn btn-default" data-toggle="tooltip" data-placement="top" title="{{ Lang::get('lang.must_log_in') }}">{{ Lang::get('lang.add_to_cart') }}</button>
							@endif
							<input class="item_product" style="display: none" type="text" value="{{ $item->id }}">
							<div class="social-icons pull-right text-right">
								<ul>
									<li>
										@if(Auth::check() && Auth::user()->role_id != 3)
											@if(is_null($item->wishlist) || empty($item->wishlist))
											<a class="" href="#!" data-toggle="tooltip" data-placement="top" title="{{ Lang::get('lang.add_wishlist') }}">
												<img src="{{ asset('images/loader.gif') }}" class="miniLoader">
												<i class="fa fa-heart btn-add-to-fav" data-value="{{ $item->id }}"></i>
											</a>
											@else
											<a class="" href="#!" data-toggle="tooltip" data-placement="top" title="{{ Lang::get('lang.already_added') }}">
												<img src="{{ asset('images/loader.gif') }}" class="miniLoader">

												<i class="fa fa-heart-o btn-add-to-fav" data-value="{{ $item->id }}"></i>
											</a>
											@endif
										@else
											<a class="" href="#!" data-toggle="tooltip" data-placement="top" title="{{ Lang::get('lang.must_log_in') }}">
												<i class="fa fa-heart"></i>
											</a>
										@endif
									</li>
									<li><a class="" href="#"><i class="fa fa-facebook"></i></a></li>
									<li><a class="" href="#"><i class="fa fa-twitter"></i></a></li>
									<li><a class="" href="#"><i class="fa fa-google-plus"></i></a></li>
								</ul>
							</div>
							<div class="clearfix"></div>
						</div>
					
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<div class="col-xs-12 no-padding">
			@if(count($related) > 0)
			<!-- //banner -->
			<div class="other-products products-grid">
				<div class="container">
					<header>
						<h3 class="like text-center">{{ Lang::get('lang.related') }}</h3>   
					</header>
					@foreach($related as $r)			
					<div class="col-md-4 product text-center">
						<a href="{{ URL::to('tienda/ver-producto/'.$r->id) }}"><img src="{{ $r->imagenes[0]->image }}" alt="" /></a>
						<div class="mask">
							<a href="{{ URL::to('tienda/ver-producto/'.$r->id) }}">{{ Lang::get('lang.see_product') }}</a>
						</div>
						<a class="product_name" href="{{ URL::to('tienda/ver-producto/'.$r->id) }}">
							@if(!Session::has('lang') || Session::get('lang') == 'es') 
								{{ $r->title_es }}
							@else
								{{ $r->title_eng }}
							@endif
						</a>
						<p><a class="item_add" href="#"><i></i> <span class="item_price">${{ $r->price }}</span></a></p>
					</div>
					@endforeach
					<div class="clearfix"></div>
			   </div>
			</div>
			<!-- content-section-ends -->
			@endif
			<div class="w3l_banner_nav_right margin-top-1">
				<div class="agileinfo_single no-padding-top">				
					<ul class="nav nav-tabs responsive" role="myTab">
					    <li role="presentation" class="active"><a href="#how-to" aria-controls="how-to" role="tab" data-toggle="tab">Home</a></li>
					    <li role="presentation"><a href="#source" aria-controls="source" role="tab" data-toggle="tab">Messages</a></li>
				  	</ul>
		  			<div class="tab-content responsive hidden-xs hidden-sm">
		    			<div class="tab-pane fade in active" id="how-to">
							<p class="tab-text">
								@if(!Session::has('lang') || Session::get('lang') == 'es') 
									{{ $item->description_es }}
								@else
									{{ $item->description_eng }}
								@endif
							</p>    
		    			</div>
		    			
			    		<div class="tab-pane fade" id="source">
					  		{{ View::make('partials.comment_section')->with('comments',$comments)->with('item',$item)  }}
				        </div>
			      	</div>		
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
	
@stop

@section('postscript')
<link rel="stylesheet" href="{{ asset('template/eshop/css/flexslider.css') }}" type="text/css" media="screen" />
<!-- FlexSlider -->
<script src="{{ asset('template/eshop/js/jquery.flexslider.js') }}"></script>

<script src="{{ asset('template/'.ShopType::getShopInfo()->template.'/js/imagezoom.js') }}"></script>


<script>
	// Can also be used with $(document).ready()
	$(window).load(function() {
		$('.flexslider').flexslider({
			animation: "slide",
			controlNav: "thumbnails"
	  	});
	  	$('.test-class').on('click', function(event) {
	  		$(this).tab('show')
	  	});
	});
</script>
@stop