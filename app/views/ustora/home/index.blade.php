@extends($store->template.'.layouts.default')

@section('content')
<div class="slider-area">
	<!-- Slider -->
	<div class="block-slider block-slider4">
		<ul class="" id="bxslider-home4">
			<li>
				<img src="{{ asset('template/'.ShopType::getShopInfo()->template.'/img/h4-slide.png')}}" alt="Slide">
				<div class="caption-group">
					<h2 class="caption title">
						iPhone <span class="primary">6 <strong>Plus</strong></span>
					</h2>
					<h4 class="caption subtitle">Dual SIM</h4>
					<a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
				</div>
			</li>
			<li><img src="{{ asset('template/'.ShopType::getShopInfo()->template.'/img/h4-slide2.png')}}" alt="Slide">
				<div class="caption-group">
					<h2 class="caption title">
						by one, get one <span class="primary">50% <strong>off</strong></span>
					</h2>
					<h4 class="caption subtitle">school supplies & backpacks.*</h4>
					<a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
				</div>
			</li>
			<li><img src="{{ asset('template/'.ShopType::getShopInfo()->template.'/img/h4-slide3.png')}}" alt="Slide">
				<div class="caption-group">
					<h2 class="caption title">
						Apple <span class="primary">Store <strong>Ipod</strong></span>
					</h2>
					<h4 class="caption subtitle">Select Item</h4>
					<a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
				</div>
			</li>
			<li><img src="{{ asset('template/'.ShopType::getShopInfo()->template.'/img/h4-slide4.png')}}" alt="Slide">
				<div class="caption-group">
				  <h2 class="caption title">
						Apple <span class="primary">Store <strong>Ipod</strong></span>
					</h2>
					<h4 class="caption subtitle">& Phone</h4>
					<a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
				</div>
			</li>
		</ul>
	</div>
	<!-- ./Slider -->
</div> <!-- End slider area -->

<div class="promo-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo1">
                    <i class="fa fa-refresh"></i>
                    <p>30 Days return</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo2">
                    <i class="fa fa-truck"></i>
                    <p>Free shipping</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo3">
                    <i class="fa fa-lock"></i>
                    <p>Secure payments</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo4">
                    <i class="fa fa-gift"></i>
                    <p>New products</p>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End promo area -->

<div class="maincontent-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="latest-product">
                    <h2 class="section-title">{{ Lang::get('lang.latest') }}</h2>
                    <div class="product-carousel">
                        @foreach($items as $i)
                        <div class="single-product">
                            <div class="product-f-image">
                            	<div class="item-image">
                                @if(strpos($i->imagenes[0]->image,'lorempixel.com'))
									<img src="{{ $i->imagenes[0]->image }}" alt="" />
								@else
									<img src="{{ asset('images/items/'.$i->imagenes[0]->image) }}" alt="" />
								@endif
                            	</div>
                                <div class="product-hover">
                                    <a href="{{ URL::to('tienda/ver-producto/'.$i->id) }}" class="view-details-link"><i class="fa fa-link"></i> {{ Lang::get('lang.see_product') }}</a>
                                </div>
                            </div>
                            
                            <div class="item-text text-center">
	                            <h2>
	                            	<a href="{{ URL::to('tienda/ver-producto/'.$i->id) }}">
	                            		@if(!Session::has('lang') || Session::get('lang') == 'es')
											{{ $i->title_es }}
										@else
											{{ $i->title_eng }}
										@endif
	                            	</a>
	                            </h2>
                            </div>
                            
                            <div class="product-carousel-price text-center">
                                <ins class="text-success">
                                    @if($i->offertItem->first())
                                        <strong>${{ $i->price - $i->price*$i->offertItem->first()['offerts']['percent']/100 }}</strong>
                                        <br>
                                        <small><del>${{ $i->price }}</del></small>
                                    @else
                                        ${{ $i->price }}
                                    @endif
                                </ins> 
                            </div> 
                        </div>
						@endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End main content area -->
{{ View::make('partials.brands-slide')->with('brands',$brands); }}

<div class="product-widget-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title">{{ Lang::get('lang.featured') }}</h2>
                    <a href="" class="wid-view-more">View All</a>
                    <div class="single-wid-product">
                        <a href="single-product.html"><img src="{{ asset('template/'.ShopType::getShopInfo()->template.'/img/product-thumb-1.jpg')}}" alt="" class="product-thumb"></a>
                        <h2><a href="single-product.html">Sony Smart TV - 2015</a></h2>
                        <div class="product-wid-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product-wid-price">
                            <ins>$400.00</ins> <del>$425.00</del>
                        </div>                            
                    </div>
                    <div class="single-wid-product">
                        <a href="single-product.html"><img src="{{ asset('template/'.ShopType::getShopInfo()->template.'/img/product-thumb-2.jpg')}}" alt="" class="product-thumb"></a>
                        <h2><a href="single-product.html">Apple new mac book 2015</a></h2>
                        <div class="product-wid-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product-wid-price">
                            <ins>$400.00</ins> <del>$425.00</del>
                        </div>                            
                    </div>
                    <div class="single-wid-product">
                        <a href="single-product.html"><img src="{{ asset('template/'.ShopType::getShopInfo()->template.'/img/product-thumb-3.jpg')}}" alt="" class="product-thumb"></a>
                        <h2><a href="single-product.html">Apple new i phone 6</a></h2>
                        <div class="product-wid-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product-wid-price">
                            <ins>$400.00</ins> <del>$425.00</del>
                        </div>                            
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title">Recently Viewed</h2>
                    <a href="#" class="wid-view-more">View All</a>
                    <div class="single-wid-product">
                        <a href="single-product.html"><img src="{{ asset('template/'.ShopType::getShopInfo()->template.'/img/product-thumb-4.jpg')}}" alt="" class="product-thumb"></a>
                        <h2><a href="single-product.html">Sony playstation microsoft</a></h2>
                        <div class="product-wid-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product-wid-price">
                            <ins>$400.00</ins> <del>$425.00</del>
                        </div>                            
                    </div>
                    <div class="single-wid-product">
                        <a href="single-product.html"><img src="{{ asset('template/'.ShopType::getShopInfo()->template.'/img/product-thumb-1.jpg')}}" alt="" class="product-thumb"></a>
                        <h2><a href="single-product.html">Sony Smart Air Condtion</a></h2>
                        <div class="product-wid-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product-wid-price">
                            <ins>$400.00</ins> <del>$425.00</del>
                        </div>                            
                    </div>
                    <div class="single-wid-product">
                        <a href="single-product.html"><img src="{{ asset('template/'.ShopType::getShopInfo()->template.'/img/product-thumb-2.jpg')}}" alt="" class="product-thumb"></a>
                        <h2><a href="single-product.html">Samsung gallaxy note 4</a></h2>
                        <div class="product-wid-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product-wid-price">
                            <ins>$400.00</ins> <del>$425.00</del>
                        </div>                            
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title">Top New</h2>
                    <a href="#" class="wid-view-more">View All</a>
                    <div class="single-wid-product">
                        <a href="single-product.html"><img src="{{ asset('template/'.ShopType::getShopInfo()->template.'/img/product-thumb-3.jpg')}}" alt="" class="product-thumb"></a>
                        <h2><a href="single-product.html">Apple new i phone 6</a></h2>
                        <div class="product-wid-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product-wid-price">
                            <ins>$400.00</ins> <del>$425.00</del>
                        </div>                            
                    </div>
                    <div class="single-wid-product">
                        <a href="single-product.html"><img src="{{ asset('template/'.ShopType::getShopInfo()->template.'/img/product-thumb-4.jpg')}}" alt="" class="product-thumb"></a>
                        <h2><a href="single-product.html">Samsung gallaxy note 4</a></h2>
                        <div class="product-wid-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product-wid-price">
                            <ins>$400.00</ins> <del>$425.00</del>
                        </div>                            
                    </div>
                    <div class="single-wid-product">
                        <a href="single-product.html"><img src="{{ asset('template/'.ShopType::getShopInfo()->template.'/img/product-thumb-1.jpg')}}" alt="" class="product-thumb"></a>
                        <h2><a href="single-product.html">Sony playstation microsoft</a></h2>
                        <div class="product-wid-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product-wid-price">
                            <ins>$400.00</ins> <del>$425.00</del>
                        </div>                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End product widget area -->
@stop