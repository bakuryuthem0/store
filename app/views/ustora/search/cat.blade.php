@extends($store->template.'.layouts.default')

@section('content')
<div class="product-big-title-area second">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>
                        	{{ Lang::get('lang.cat_filter') }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- content-section-starts -->
<div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
            	{{ $sideBar }}
            	<div class="col-md-8 new-product">
					<div class="new-product-top formulario">
						<div class="product-breadcroumb">
		                    <a href="{{ URL::to('/') }}">Home</a>
		                    <a href="#!">
			                   {{ strtolower(Lang::get('lang.cat_filter')) }}
		                    </a>
		                    <ul class="list-unstyled pull-right previous">
					        	<li><a href="{{ URL::previous() }}">{{ Lang::get('lang.get_back') }}</a></li>
					        </ul>
		                </div>
					</div>
					
					<div class="col-xs-12 no-padding margin-top-1">
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
					
					@foreach($items as $i)
		                <div class="col-md-4 col-sm-6">
		                    <div class="single-shop-product">
		                        <div class="product-upper">
		                        	<div class="item-image-cat">
			                            @if(strpos($i->imagenes[0]->image,'lorempixel.com'))
											<img src="{{ $i->imagenes[0]->image }}" alt="" />
										@else
											<img src="{{ asset('images/items/'.$i->imagenes[0]->image) }}" alt="" />
										@endif
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
		                            <ins class="">
		                            	@if($i->offertItem->first())
											<strong>${{ $i->price - $i->price*$i->offertItem->first()['offerts']['percent']/100 }}</strong>
											<br>
											<small><del>${{ $i->price }}</del></small>
										@else
											${{ $i->price }}
										@endif
		                            </ins>
		                        </div>  
		                        
		                        <div class="product-option-shop text-center">
		                            <a class="btn third " href="{{ URL::to('tienda/ver-producto/'.$i->id) }}">{{ Lang::get('lang.see_details') }}</a>
		                        </div>                       
		                    </div>
		                </div>
		            @endforeach    
	            </div>
            </div>
            <div class="row">
                <div class="col-md-12">
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
			                                echo '<li><a class="" href="'.$url.$paginatorFilter.'">&laquo; Primera</a></li>';
			                            }
			                            if (($currentPage-1) < $start) {
			                                echo '<li class="disabled"><a href="#!">&laquo;</a></li>';   
			                            }else
			                            {
			                                echo '<li><a href="'.$items->getUrl($currentPage-1).$paginatorFilter.'">&laquo;</a></li>';
			                            }
			                            for($i = $start; $i<=$end;$i++)
			                            {
			                                if ($currentPage == $i) {
			                                    echo '<li class="active"><a href="#!">'.$i.'</a></li>';
			                                }else
			                                {
			                                    echo '<li><a href="'.$items->getUrl($i).$paginatorFilter.'">'.$i.'</a></li>';
			                                }
			                            }
			                            if (($currentPage+1) > $end) {
			                                echo '<li class="disabled"><a href="#!">&raquo;</a></li>' ;
			                            }else
			                            {
			                                echo '<li><a href="'.$items->getUrl($currentPage+1).$paginatorFilter.'">&raquo;</a></li>';
			                            }
			                            if ($currentPage >= $lastPage)
			                            {
			                                echo '<li class="disabled"><a href="#!">Última &raquo;</a></li>';
			                            }
			                            else
			                            {
			                                $url = $items->getUrl($lastPage);
			                                echo '<li><a class="" href="'.$url.$paginatorFilter.'">Última &raquo;</a></li>';
			                            }
			                        ?>
			                        </ul>
			                    @endif
			                </nav>
			            </div>
		            @endif
                </div>
            </div>
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