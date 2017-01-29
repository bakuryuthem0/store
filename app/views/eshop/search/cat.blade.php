@extends($store->template.'.layouts.default')

@section('content')
<!-- content-section-starts -->
<div class="container">
	<div class="products-page">
		{{ $sideBar }}
		<div class="new-product">
			<div class="new-product-top formulario">
				<ul class="product-top-list">
					<li class="home">
	                   <a href="index.html" title="Go to Home Page">{{ Lang::get('lang.home_title') }}</a>&nbsp;
	                   <span>&gt;</span>
	                </li>
	                <li class="women">
	                   {{ strtolower(Lang::get('lang.cat_filter')) }}
	                </li>
				</ul>
				<p class="back"><a href="{{ URL::previous() }}">{{ Lang::get('lang.get_back') }}</a></p>
				<div class="clearfix"></div>
			</div>
			
			<div class="col-xs-12 no-padding">
				<form method="GET" action="{{ Request::url() }}" class="filter-form">
					@if(isset($busq)) 
					<input type="hidden" name="busq" value="{{ $busq }}">
					@endif
					<div class="text-left valign half-size">
						<div class="input-group no-margin-bottom">
							<label class="">{{ Lang::get('lang.sort_type') }}</label>
                            <div class="input-group">
                              <select class="form-control filter-select sort_type" name="sort_type">
                                 <option value="created_at" @if(!isset($sort_type) || $sort_type == 'created_at') selected @endif>{{ Lang::get('lang.created_at_filter') }}</option>
                                 <option value="price" @if(isset($sort_type) && $sort_type == 'price') selected @endif>{{ Lang::get('lang.price_filter') }}</option>
                                 <option value="stock" @if(isset($sort_type) && $sort_type == 'stock') selected @endif>{{ Lang::get('lang.stock_filter') }}</option>
                              </select>
                              <span class="input-group-btn btnLoader">
                                 <button class="btn btn-default btn-filtralo" type="button">
									<i class="fa fa-search"></i>
                                 </button>
                              </span>
                           </div>
                        </div>
					</div>
					<div class="limiter visible-desktop text-right valign half-size">
						<label>Show</label>
						<select class="filter-select" name="paginate_number">
							<option value="6" @if(!isset($paginate_number) || $paginate_number == '6') selected @endif>
								6                
							</option>
							<option value="12" @if(isset($paginate_number) && $paginate_number == '12') selected @endif>
								12                
							</option>
							<option value="24" @if(isset($paginate_number) && $paginate_number == '24') selected @endif>
								24                
							</option>
						</select> per page
					</div>
					<img src="{{ asset('template/'.$store->template.'/images/arrow2.gif') }}" alt="" class="arrow-sorted @if(isset($sort_by) && $sort_by == 'ASC') rotated @endif v-middle">
					<input type="hidden" @if(!isset($sort_by) || $sort_by == 'DESC') value="DESC" @else  value="ASC" @endif class="sort_by" name="sort_by">
				</form>
			</div>
			<div id="cbp-vm" class="cbp-vm-switcher no-padding @if(!Session::has('show-type') || Session::get('show-type') == 'grid') cbp-vm-view-grid @else cbp-vm-view-list @endif">
				<div class="cbp-vm-options">
					<a href="#" class="change-grid cbp-vm-icon cbp-vm-grid @if(!Session::has('show-type') || Session::get('show-type') == 'grid') cbp-vm-selected @endif" data-view="cbp-vm-view-grid" title="grid"></a>
					<a href="#" class="change-grid cbp-vm-icon cbp-vm-list @if(Session::has('show-type') && Session::get('show-type') == 'list') cbp-vm-selected @endif" data-view="cbp-vm-view-list" title="list"></a>
				</div>
				<div class="clearfix"></div>
				<ul>
					@foreach($items as $i)
						<li>
							<div class="cbp-vm-image item-image-search">
								<a class="" href="{{ URL::to('tienda/ver-producto/'.$i->id) }}">
									<img src="{{ strpos($i->imagenes->first()->image, 'lorem') ? $i->imagenes->first()->image:  asset('images/items'.$i->imagenes->first()->image) }}">
								</a>
							</div>
							<div class="cbp-vm-title item-text-search">
								<h4 class="">
									@if(!Session::has('lang') || Session::get('lang') == 'es')
										{{ $i->title_es }}
									@else
										{{ $i->title_eng }}
									@endif
								</h4>
							</div>
							<div class="cbp-vm-price">
								@if($i->offertItem->first())
									<strong>${{ $i->price - $i->price*$i->offertItem->first()['offerts']['percent']/100 }}</strong>
									<br>
									<small><del>${{ $i->price }}</del></small>
								@else
									${{ $i->price }}
								@endif
							</div>
							<div class="cbp-vm-details">
								@if(!Session::has('lang') || Session::get('lang') == 'es')
									{{ substr($i->description_es, 0, 50) }}
								@else
									{{ substr($i->description_eng, 0, 50) }}
								@endif
							</div>
							<a class="cbp-vm-icon cbp-vm-add first" href="{{ URL::to('tienda/ver-producto/'.$i->id) }}">{{ Lang::get('lang.see_details') }}</a>
						</li>
					@endforeach
				</ul>
			</div>
			@if(count($items) > 0)
            <div class="blog-pagination">
                <nav role="navigation">
                    <?php  $presenter = new Illuminate\Pagination\BootstrapPresenter($items); ?>
                    @if ($items->getLastPage() > 1)
                        <ul class="pagination">
                        <?php
                            $beforeAndAfter = 3;
                            $currentPage = $items->getCurrentPage();
                            $lastPage = $items->getLastPage();
                            $start = $currentPage - $beforeAndAfter;
                            if($start < 1)
                            {
                                $pos = $start - 1;
                                $start = $currentPage - ($beforeAndAfter + $pos);
                            }
                            $end = $currentPage + $beforeAndAfter;
                            if($end > $lastPage)
                            {
                                $pos = $end - $lastPage;
                                $end = $end - $pos;
                            }
                            if ($currentPage <= 1)
                            {
                                echo '<li class="disabled"><a href="#!">&laquo; Primera</a></li>';
                            }
                            else
                            {
                                $url = $items->getUrl(1);
                                echo '<li><a class="" href="'.$url.(isset($busq) ? '&busq='.$busq : "").$paginatorFilter.'">&laquo; Primera</a></li>';
                            }
                            if (($currentPage-1) < $start) {
                                echo '<li class="disabled"><a href="#!">&laquo;</a></li>';   
                            }else
                            {
                                echo '<li><a href="'.$items->getUrl($currentPage-1).(isset($busq) ? '&busq='.$busq : "").$paginatorFilter.'">&laquo;</a></li>';
                            }
                            for($i = $start; $i<=$end;$i++)
                            {
                                if ($currentPage == $i) {
                                    echo '<li class="active"><a href="#!">'.$i.'</a></li>';
                                }else
                                {
                                    echo '<li><a href="'.$items->getUrl($i).(isset($busq) ? '&busq='.$busq : "").$paginatorFilter.'">'.$i.'</a></li>';
                                }
                            }
                            if (($currentPage+1) > $end) {
                                echo '<li class="disabled"><a href="#!">&raquo;</a></li>' ;
                            }else
                            {
                                echo '<li><a href="'.$items->getUrl($currentPage+1).(isset($busq) ? '&busq='.$busq : "").$paginatorFilter.'">&raquo;</a></li>';
                            }
                            if ($currentPage >= $lastPage)
                            {
                                echo '<li class="disabled"><a href="#!">Última &raquo;</a></li>';
                            }
                            else
                            {
                                $url = $items->getUrl($lastPage);
                                echo '<li><a class="" href="'.$url.(isset($busq) ? '&busq='.$busq : "").$paginatorFilter.'">Última &raquo;</a></li>';
                            }
                        ?>
                        </ul>
                    @endif
                </nav>
            </div>
            @endif
			<div class="clearfix"></div>
			
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="clearfix"></div>
</div>
<!-- content-section-ends -->
<div class="other-products">
	<div class="container">
		<h3 class="like text-center">Featured Collection</h3>
		<ul id="flexiselDemo3">
			<li><a href="single.html"><img src="images/l1.jpg" class="img-responsive"/></a>
				<div class="product liked-product simpleCart_shelfItem">
					<a class="like_name" href="single.html">Perfectly simple</a>
					<p><a class="item_add" href="#"><i></i> <span class=" item_price">$759</span></a></p>
				</div>
			</li>
			<li>
				<a href="single.html"><img src="images/l2.jpg" class="img-responsive"/></a>
				<div class="product liked-product simpleCart_shelfItem">
					<a class="like_name" href="single.html">Praising pain</a>
					<p><a class="item_add" href="#"><i></i> <span class=" item_price">$699</span></a></p>
				</div>
			</li>
			<li>
				<a href="single.html"><img src="images/l3.jpg" class="img-responsive"/></a>
				<div class="product liked-product simpleCart_shelfItem">
					<a class="like_name" href="single.html">Neque porro</a>
					<p><a class="item_add" href="#"><i></i> <span class=" item_price">$329</span></a></p>
				</div>
			</li>
			<li>
				<a href="single.html"><img src="images/l4.jpg" class="img-responsive"/></a>
				<div class="product liked-product simpleCart_shelfItem">
					<a class="like_name" href="single.html">Equal blame</a>
					<p><a class="item_add" href="#"><i></i> <span class=" item_price">$499</span></a></p>
				</div>
			</li>
			<li>
				<a href="single.html"><img src="images/l5.jpg" class="img-responsive"/></a>
				<div class="product liked-product simpleCart_shelfItem">
					<a class="like_name" href="single.html">Perfectly simple</a>
					<p><a class="item_add" href="#"><i></i> <span class=" item_price">$649</span></a></p>
					</div>
			</li>
		</ul>
		
	</div>
</div>
<!-- content-section-ends-here -->
@stop

@section('postscript')
	@if($store->store_type == 1)
		<script type="text/javascript" src="{{ asset('js/store_type1.js') }}"></script>
	@endif

<link href="{{ asset('template/eshop/css/component.css') }}" rel='stylesheet' type='text/css' />
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
		$('.change-grid').on('click', function(event) {
			var grid = $(this).data('view').split('-');
			$.get(getRootUrl()+'/cambiar-vista/'+grid['3'], function(data) {
				
			});
		});
		$('.arrow-sorted').on('click', function(event) {
			var esto = $(this);
			if (esto.hasClass('rotated')) {
				esto.removeClass('rotated');
				$('.sort_by').val('DESC');
			}else
			{
				esto.addClass('rotated');
				$('.sort_by').val('ASC');
			}
		});
	});
</script>
<script type="text/javascript" src="{{ asset('template/eshop/js/jquery.flexisel.js') }}"></script>
<script src="{{ asset('template/eshop/js/cbpViewModeSwitch.js') }}" type="text/javascript"></script>
<script src="{{ asset('template/eshop/js/classie.js') }}" type="text/javascript"></script>
@stop