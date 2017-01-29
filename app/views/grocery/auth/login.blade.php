@extends($store->template.'.layouts.default')

@section('content')
<!-- products-breadcrumb -->
<div class="products-breadcrumb">
	<div class="container">
		<ul class="col-xs-6 col-md-3">
			<li>
				<i class="fa fa-home" aria-hidden="true"></i>
				<a href="{{ URL::to('/') }}"> {{ Lang::get('lang.home_title') }}</a>
				<span>|</span>
			</li>
			<li>
				{{ Lang::get('lang.login_title').' '.Lang::get('lang.o_or_or').' '.Lang::get('lang.registration') }}
			</li>
		</ul>
		<ul class="col-xs-6 col-md-3 previous pull-right text-right">
	   		<li><a href="{{ URL::previous() }}">{{ Lang::get('lang.get_back') }}</a></li>
	  	</ul>
	</div>
</div>
<!-- //products-breadcrumb -->
<!-- login -->
		<div class="w3_login">
			<h3>{{ Lang::get('lang.login_title').' '.Lang::get('lang.o_or_or').' '.Lang::get('lang.registration') }}</h3>
			<div class="w3_login_module margin-top-1">
				<div class="col-xs-12 col-md-7">
					<div class="col-md-4 wthree_news_top_serv_btm_grid">
						<div class="wthree_news_top_serv_btm_grid_icon text-center">
							<i class="fa fa-shopping-cart" aria-hidden="true"></i>
						</div>
						<h3>{{ Lang::get('lang.login_new_costumer') }}</h3>
						<p class="text-justify">{{ Lang::get('lang.login_text1') }}</p>
					</div>
					<div class="col-md-4 wthree_news_top_serv_btm_grid">
						<div class="wthree_news_top_serv_btm_grid_icon text-center">
							<i class="fa fa-bar-chart" aria-hidden="true"></i>
						</div>
						<h3>officiis debitis aut rerum</h3>
						<p class="text-justify">Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus 
							saepe eveniet ut et voluptates repudiandae sint et.</p>
					</div>
					<div class="col-md-4 wthree_news_top_serv_btm_grid">
						<div class="wthree_news_top_serv_btm_grid_icon text-center">
							<i class="fa fa-truck" aria-hidden="true"></i>
						</div>
						<h3>eveniet ut et voluptates</h3>
						<p class="text-justify">Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus 
							saepe eveniet ut et voluptates repudiandae sint et.</p>
					</div>
				</div>
				<div class="col-xs-12 col-md-5">
					<div class="module form-module pull-right">
					  <div class="toggle"><i class="fa fa-times fa-pencil"></i>
						<div class="tooltip">{{ Lang::get('lang.register_title') }}</div>
					  </div>
					  <div class="form" @if(Input::old('address')) style="display:none;" @endif>
					  	@if(Session::has('success'))
				  		<div class="alert alert-success">
				  			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				  			{{ Session::get('success') }}
				  		</div>
				  		@elseif(Session::has('danger'))
				  		<div class="alert alert-danger">
				  			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				  			{{ Session::get('danger') }}
				  		</div>
				  		@endif
						<h2>Login to your account</h2>
						<form action="{{ URL::to('tienda/login/enviar') }}" method="post">
						  	<input type="text" name="email" placeholder="{{ Lang::get('lang.login_input1') }}" required=" ">
						  	<input type="password" name="password" placeholder="{{ Lang::get('lang.register_password') }}" required=" ">
						  	<input type="submit" value="Login">
							{{ Form::token() }}
						</form>
					  </div>
					  <div class="form" @if(Input::old('address')) style="display:block;" @endif>
					  	<p>{{ Lang::get('lang.register_text1') }}</p>
						<p>{{ Lang::get('lang.register_text2') }}, <a href="{{ URL::to('inicio/login') }}">{{ Lang::get('lang.click_here') }}</a></p>
						 <form method="POST" action="{{ URL::to('inicio/registrese/enviar') }}">
								 <input class="register-input" type="text" name="name" value="{{ Input::old('name') }}" placeholder="{{ Lang::get('lang.register_firstname') }}: ">
								 @if($errors->has('name'))
			                        @foreach($errors->get('name') as $err)
			                          <div class="alert alert-danger formulario"><p class="bg-danger">{{ $err }}</p></div>
			                        @endforeach
			                     @endif
								 <input class="register-input" type="text" name="lastname" value="{{ Input::old('lastname') }}" placeholder="{{ Lang::get('lang.register_lastname') }}: ">
								 @if($errors->has('lastname'))
			                        @foreach($errors->get('lastname') as $err)
			                          <div class="alert alert-danger formulario"><p class="bg-danger">{{ $err }}</p></div>
			                        @endforeach
			                     @endif
								 <input class="register-input" type="email" name="email" value="{{ Input::old('email') }}" placeholder="Email: ">
								 @if($errors->has('email'))
			                        @foreach($errors->get('email') as $err)
			                          <div class="alert alert-danger formulario"><p class="bg-danger">{{ $err }}</p></div>
			                        @endforeach
			                     @endif
								 <input class="register-input" type="password" name="password" value="" placeholder="{{ Lang::get('lang.register_password') }}: ">
								 @if($errors->has('password'))
			                        @foreach($errors->get('password') as $err)
			                          <div class="alert alert-danger formulario"><p class="bg-danger">{{ $err }}</p></div>
			                        @endforeach
			                     @endif
								 <input class="register-input" type="password" name="password_confirmation" value="" placeholder="{{ Lang::get('lang.register_confirm_pass') }}:">
								 @if($errors->has('password_confirmation'))
			                        @foreach($errors->get('password_confirmation') as $err)
			                          <div class="alert alert-danger formulario"><p class="bg-danger">{{ $err }}</p></div>
			                        @endforeach
			                     @endif
								 <input class="register-input" type="text" name="address" value="{{ Input::old('address') }}" placeholder="{{ Lang::get('lang.register_address') }}:">
								 @if($errors->has('address'))
			                        @foreach($errors->get('address') as $err)
			                          <div class="alert alert-danger formulario"><p class="bg-danger">{{ $err }}</p></div>
			                        @endforeach
			                     @endif
							 <input type="submit" value="{{ Lang::get('lang.register_btn') }}" class="third">
							 <p class="click">{{ Lang::get('lang.register_text3') }}  <a href="#!">{{ Lang::get('lang.register_text4') }}.</a></p> 

						</form>
					  </div>
					  <div class="cta"><a href="#">{{ Lang::get('lang.forgot_pass') }}</a></div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<script>
				$('.toggle').click(function(){
				  // Switches the Icon
				  $(this).children('i').toggleClass('fa-pencil');
				  // Switches the forms  
				  $('.form').animate({
					height: "toggle",
					'padding-top': 'toggle',
					'padding-bottom': 'toggle',
					opacity: "toggle"
				  }, "slow");
				});
			</script>
		</div>	
		<!-- //login -->
<!-- //banner -->
@stop