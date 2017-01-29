<div class="w3l_banner_nav_left margin-top-1">
	<nav class="navbar nav_bottom">
	 <!-- Brand and toggle get grouped for better mobile display -->
	  <div class="navbar-header nav_2">
		  <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
	   </div> 
	   <!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
			<ul class="nav navbar-nav nav_1 second">
				<li class="side-bar-title first ">
					<h3 class="text-center">{{ $cat_title }}</h3>
				</li>
				@foreach($cat_list as $c)
					<li @if(isset($active) && $active == $c->id) class="third" @endif>
						<a href="{{ URL::to('tienda/productos/'.$cat_type.'/'.$c->id) }}">
							{{ Session::get('lang') ? $c->description_es : $c->description_eng }}
						</a>
					</li>
				@endforeach 
			</ul>
		 </div><!-- /.navbar-collapse -->
	</nav>
	@if(!isset($self))
	<div class="filter-container margin-top-1">
		<form method="GET" action="{{ URL::to(Request::url()) }}" class="form-filter">
			@if(isset($busq))
				<input type="hidden" name="busq" class="to-filter busq" value="{{ $busq }}">
			@endif
		</form>
		<div class="col-xs-12">
			<h3 class="text-center">{{ Lang::get('lang.filter') }}</h3>
		</div>
		@if($store->store_type == 1)
			<div class="col-xs-12"><label class="">{{ ucfirst(strtolower(Lang::get('lang.product_size'))) }}</label></div>
			<div class="col-xs-12 formulario">
				<select name="filter-attr" class="filter-size form-control">
					<option value="">{{ Lang::get('lang.select_an_option') }}</option>
					@foreach(ShopType::getTallas() as $t)
						<option value="{{ $t->id }}" @if(isset($talla) && $talla == $t->id) selected @endif>{{ $t->description }}</option>
					@endforeach
				</select>
			</div>
			<div class="col-xs-12"><label class="">{{ ucfirst(strtolower(Lang::get('lang.product_color'))) }}</label></div>
			<div class="col-xs-12 formulario">
				<select name="filter-attr" class="filter-color form-control">
					<option value="">{{ Lang::get('lang.select_an_option') }}</option>
					@foreach(ShopType::getColores() as $c)
						<option value="{{ $c->id }}" @if(isset($color) && $color == $c->id) selected @endif>{{ $c->description }}</option>
					@endforeach
				</select>
			</div>
			<div class="col-xs-12"><label class="">{{ ucfirst(strtolower(Lang::get('lang.product_fabric'))) }}</label></div>
			<div class="col-xs-12 formulario">
				<select name="filter-attr" class="filter-fabric form-control">
					<option value="">{{ Lang::get('lang.select_an_option') }}</option>
					@foreach(ShopType::getMateriales() as $f)
						<option value="{{ $f->id }}" @if(isset($material) && $material == $f->id) selected @endif>{{ $f->description }}</option>
					@endforeach
				</select>
			</div>
		@endif
		<div class="col-xs-12"><label class="">{{ Lang::get('lang.price_filter') }}</label></div>
		<div class="col-xs-12 formulario">
			<input type="text" class="form-control min" name="min" placeholder="Min:" @if(isset($min)) value="{{ $min }}" @endif>
		</div>
		<div class="col-xs-12 formulario contInputFilter">
			<input type="text" class="form-control max" name="max" placeholder="Max:" @if(isset($max)) value="{{ $max }}" @endif>
		</div>

		<div class="col-xs-12 formulario">
			<button class="btn btn-default btn-xs btn-flat btn-filtralo" title="Filtrar">Filtrar <strong><i class="fa fa-angle-right"></i></strong></button>
		</div>
		<div class="clearfix"></div>
	</div>
	@endif
</div>