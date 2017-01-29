@extends($store->template.'.layouts.default')

@section('content')
<!-- registration-form -->
<div class="registration-form">
	<div class="container">
		<div class="dreamcrub">
		   	 <ul class="breadcrumbs">
                <li class="home">
                   <a href="index.html" title="{{ Lang::get('lang.go_home_title') }}">{{ Lang::get('lang.home_title') }}</a>&nbsp;
                   <span>&gt;</span>
                </li>
                <li class="women">
                   {{ Lang::get('lang.registration') }}
                </li>
            </ul>
            <ul class="previous">
            	<li><a href="{{ URL::previous() }}">{{ Lang::get('lang.get_back') }}</a></li>
            </ul>
            <div class="clearfix"></div>
	   </div>
		<h2>{{ Lang::get('lang.registration') }}</h2>
		@if(Session::get('danger'))
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			{{ Session::get('danger') }}
		</div>
		@endif
		<div class="registration-grids">
			<div class="reg-form">
				<div class="reg">
					 <p>{{ Lang::get('lang.register_text1') }}</p>
					 <p>{{ Lang::get('lang.register_text2') }}, <a href="{{ URL::to('inicio/login') }}">{{ Lang::get('lang.click_here') }}</a></p>
					 <form method="POST" action="{{ URL::to('inicio/registrese/enviar') }}">
						 <ul>
							 <li class="text-info">{{ Lang::get('lang.register_firstname') }}: </li>
							 <li><input class="register-input" type="text" name="name" value="{{ Input::old('name') }}"></li>
							 @if($errors->has('name'))
		                        @foreach($errors->get('name') as $err)
		                          <li class="text-info error"><div><p class="bg-danger">{{ $err }}</p></div></li>
		                        @endforeach
		                     @endif
						 </ul>
						 <ul>
							 <li class="text-info">{{ Lang::get('lang.register_lastname') }}: </li>
							 <li><input class="register-input" type="text" name="lastname" value="{{ Input::old('lastname') }}"></li>
							 @if($errors->has('lastname'))
		                        @foreach($errors->get('lastname') as $err)
		                          <li class="text-info error"><div><p class="bg-danger">{{ $err }}</p></div></li>
		                        @endforeach
		                     @endif
						 </ul>				 
						<ul>
							 <li class="text-info">Email: </li>
							 <li><input class="register-input" type="email" name="email" value="{{ Input::old('email') }}"></li>
							 @if($errors->has('email'))
		                        @foreach($errors->get('email') as $err)
		                          <li class="text-info error"><div><p class="bg-danger">{{ $err }}</p></div></li>
		                        @endforeach
		                     @endif
						 </ul>
						 <ul>
							 <li class="text-info">{{ Lang::get('lang.register_password') }}: </li>
							 <li><input class="register-input" type="password" name="password" value=""></li>
							 @if($errors->has('password'))
		                        @foreach($errors->get('password') as $err)
		                          <li class="text-info error"><div><p class="bg-danger">{{ $err }}</p></div></li>
		                        @endforeach
		                     @endif
						 </ul>
						 <ul>
							 <li class="text-info">{{ Lang::get('lang.register_confirm_pass') }}:</li>
							 <li><input class="register-input" type="password" name="password_confirmation" value="" data-toggle="popover" data-trigger="manual" data-title="{{ Lang::get('lang.attention') }}" data-content="{{ Lang::get('lang.passwords_confirmation') }}"></li>
							 @if($errors->has('password_confirmation'))
		                        @foreach($errors->get('password_confirmation') as $err)
		                          <li class="text-info error"><div><p class="bg-danger">{{ $err }}</p></div></li>
		                        @endforeach
		                     @endif
						 </ul>
						 <ul>
							 <li class="text-info">{{ Lang::get('lang.register_address') }}:</li>
							 <li><input class="register-input" type="text" name="address" value="{{ Input::old('address') }}"></li>
							 @if($errors->has('address'))
		                        @foreach($errors->get('address') as $err)
		                          <li class="text-info error"><div><p class="bg-danger">{{ $err }}</p></div></li>
		                        @endforeach
		                     @endif
						 </ul>						
						 <input type="submit" value="{{ Lang::get('lang.register_btn') }}" class="third">
						 <p class="click">{{ Lang::get('lang.register_text3') }}  <a href="#!">{{ Lang::get('lang.register_text4') }}.</a></p> 
					 </form>
				 </div>
			</div>
			<div class="reg-right">
				 <h3>Completely Free Account</h3>
				 <div class="strip"></div>
				 <p>Pellentesque neque leo, dictum sit amet accumsan non, dignissim ac mauris. Mauris rhoncus, lectus tincidunt tempus aliquam, odio 
				 libero tincidunt metus, sed euismod elit enim ut mi. Nulla porttitor et dolor sed condimentum. Praesent porttitor lorem dui, in pulvinar enim rhoncus vitae. Curabitur tincidunt, turpis ac lobortis hendrerit, ex elit vestibulum est, at faucibus erat ligula non neque.</p>
				 <h3 class="lorem">Lorem ipsum dolor.</h3>
				 <div class="strip"></div>
				 <p>Tincidunt metus, sed euismod elit enim ut mi. Nulla porttitor et dolor sed condimentum. Praesent porttitor lorem dui, in pulvinar enim rhoncus vitae. Curabitur tincidunt, turpis ac lobortis hendrerit, ex elit vestibulum est, at faucibus erat ligula non neque.</p>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<!-- registration-form -->
@stop

@section('postscript')
<script type="text/javascript">

	jQuery(document).ready(function($) {
		$('input[name=password_confirmation]').on('blur', function(event) {
			if ($(this).val() != $('input[name=password]').val()) {
				$(this).popover('show');
			};
		});
		$('input[name=password_confirmation]').on('focus', function(event) {
			$(this).popover('hide');
		});
	});
</script>
@stop