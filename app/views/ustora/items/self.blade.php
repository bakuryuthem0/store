@extends($store->template.'.layouts.default')
@section('content')

    <div class="product-big-title-area second">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>
                        	@if(!Session::has('lang') || Session::get('lang') == "es")
								{{ $item->title_es }}
							@else
								{{ $item->title_eng }}
							@endif
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
				{{ $sideBar }}
                <div class="col-md-8">
                    <div class="product-content-right simpleCart_shelfItem">
                        <div class="product-breadcroumb">
                            <a href="{{ URL::to('/') }}">Home</a>
                            <a href="{{ URL::to('tienda/productos/categorias/') }}">
                            	@if(!Session::has('lang') || Session::get('lang') == "es")
									{{ $item->categoria->description_es }}
								@else
									{{ $item->categoria->description_eng }}
								@endif
                            </a>
                            <a href="#!">
                            	@if(!Session::has('lang') || Session::get('lang') == "es")
									{{ $item->title_es }}
								@else
									{{ $item->title_eng }}
								@endif
                            </a>
                            <ul class="list-unstyled pull-right previous">
					        	<li><a href="{{ URL::previous() }}">{{ Lang::get('lang.get_back') }}</a></li>
					        </ul>
                        </div>
                        
                        <div class="row">
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
                            
                            <div class="col-sm-7">
                                <div class="product-inner">
                                    <h2 class="product-name item_name">
                                    	@if(!Session::has('lang') || Session::get('lang') == "es")
											{{ $item->title_es }}
										@else
											{{ $item->title_eng }}
										@endif
                                    </h2>
                                    <div class="text-success">
                                        <span class="item_price">${{ $item->price }}</span>
                                    </div>    
                                    @if($store->store_type == 1)
									<div class="col-xs-12 formulario no-padding margin-top-1">
										<div class="col-xs-12 col-md-6 no-padding text-left">{{ Lang::get('lang.product_fabric') }}</div>
										<div class="col-xs-12 col-md-6 no-padding text-right">
											<select class="btn btn-default item-details item_fabric">
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
											<select class="btn btn-default item-details item_color">
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
											<select class="btn btn-default item-details item_size">
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
									@endif
                                    <divc lass="col-xs-12 margin-top-1">
                                    	@if(Auth::check() && Auth::user()->role_id != 3)
											<button class="btn third item_add pull-right">{{ Lang::get('lang.add_to_cart') }}</button>
										@else
											<button class="btn third pull-right" data-toggle="tooltip" data-placement="top" title="{{ Lang::get('lang.must_log_in') }}">{{ Lang::get('lang.add_to_cart') }}</button>
										@endif
										<input class="item_product" style="display: none" type="text" value="{{ $item->id }}">
                                    </div>
                                    
                                    <div class="col-xs-12 margin-top-1 product-inner-category">
                                        <p>Category: 
                                        	<a href="">
                                        		@if(!Session::has('lang') || Session::get('lang') == "es")
													{{ $item->categoria->description_es }}
												@else
													{{ $item->categoria->description_eng }}
												@endif
                                        	</a>. Tags: 
                                    		<a href="">awesome</a>
                                    	</p>
                                    </div> 
                                    <div class="col-xs-12 social-icons text-right">
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
                                </div>
                            </div>
                        </div>
                        
                    </div>	
                </div>
                <div class="col-xs-12 margin-top-1" role="tabpanel">
                    <ul class="product-tab" role="tablist">
                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">{{ Lang::get('lang.description') }}</a></li>
                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Message</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="home">
                            <h2>{{ Lang::get('lang.description') }}</h2>  
                            <p class="text-justify">
                            	@if(!Session::has('lang') || Session::get('lang') == "es")
									{{ $item->description_es }}
								@else
									{{ $item->description_eng }}
								@endif
                            </p>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="profile">
                            {{ View::make('partials.comment_section')->with('comments',$comments)->with('item',$item)  }}
                        </div>
                    </div>
                </div>
				@if(count($related) > 0)
                <div class="related-products-wrapper">
                    <h2 class="related-products-title">{{ Lang::get('lang.related') }}</h2>
                    <div class="related-products-carousel">
						@foreach($related as $r)			
                            <div class="single-product">
                                <div class="product-f-image">
                                    <a href="{{ URL::to('tienda/ver-producto/'.$r->id) }}"><img src="{{ $r->imagenes[0]->image }}" alt="" /></a>
                                    <div class="product-hover">
                                        <a href="" class="view-details-link"><i class="fa fa-link"></i> {{ Lang::get('lang.see_details') }}</a>
                                    </div>
                                </div>

                                <h2>
                                	<a href="{{ URL::to('tienda/ver-producto/'.$r->id) }}">
                                		@if(!Session::has('lang') || Session::get('lang') == "es")
											{{ $r->title_es }}
										@else
											{{ $r->title_eng }}
										@endif
                                	</a>
                                </h2>

                                <div class="product-carousel-price">
                                    <span class="text-success">${{ $r->price }}</span>
                                </div> 
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
			
@if(count($related) > 0)
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
			<p><span class="item_price">${{ $r->price }}</span></p>
		</div>
		@endforeach
		<div class="clearfix"></div>
   </div>
</div>
<!-- content-section-ends -->
@endif
@stop

@section('postscript')
<link rel="stylesheet" href="{{ asset('plugins/flexslider/flexslider.css') }}" type="text/css" media="screen" />
<!-- FlexSlider -->
<script defer src="{{ asset('plugins/flexslider/jquery.flexslider.js') }}"></script>

<script src="{{ asset('plugins/imagezoom/imagezoom.js') }}"></script>

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
	  $('[data-toggle="tooltip"]').tooltip();
	});
</script>
@stop