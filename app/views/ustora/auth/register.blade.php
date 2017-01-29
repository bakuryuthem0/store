@extends($store->template.'.layouts.default')

@section('content')
<div class="product-big-title-area second">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>
						{{ Lang::get('lang.registration') }}
                    </h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- registration-form -->
<div class="registration-form mid-section">
	<div class="container">
		<div class="product-breadcroumb margin-top-1">
            <a href="{{ URL::to('/') }}">{{ Lang::get('lang.go_home_title') }}</a>
            <a href="#!">
				{{ Lang::get('lang.registration') }}
            </a>
	        <ul class="list-unstyled pull-right previous">
	        	<li><a href="{{ URL::previous() }}">{{ Lang::get('lang.get_back') }}</a></li>
	        </ul>
        </div>
		@if(Session::get('danger'))
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			{{ Session::get('danger') }}
		</div>
		@endif
		<div class="col-xs-12 no-padding registration-grids">
			<div class="col-xs-12 col-md-6 reg-form">
				<h2 class="margin-top-1">{{ Lang::get('lang.registration') }}</h2>
				<div class="reg">
					 <p>{{ Lang::get('lang.register_text1') }}</p>
					 <p>{{ Lang::get('lang.register_text2') }}, <a href="{{ URL::to('inicio/login') }}">{{ Lang::get('lang.click_here') }}</a></p>
					 <form method="POST" action="{{ URL::to('inicio/registrese/enviar') }}">
						 <div class="formulario">
							 <label>{{ Lang::get('lang.register_firstname') }}: </label>
							 <input class="register-input form-control" type="text" name="name" value="{{ Input::old('name') }}">
							 @if($errors->has('name'))
		                        @foreach($errors->get('name') as $err)
		                          <li class="text-info error"><div><p class="bg-danger">{{ $err }}</p></div></li>
		                        @endforeach
		                     @endif
						 </div>
						 <div class="formulario">
							 <label>{{ Lang::get('lang.register_lastname') }}: </label>
							 <input class="register-input form-control" type="text" name="lastname" value="{{ Input::old('lastname') }}">
							 @if($errors->has('lastname'))
		                        @foreach($errors->get('lastname') as $err)
		                          <li class="text-info error"><div><p class="bg-danger">{{ $err }}</p></div></li>
		                        @endforeach
		                     @endif
						</div>				 
						<div class="formulario">
							 <label>Email: </label>
							 <input class="register-input form-control" type="email" name="email" value="{{ Input::old('email') }}">
							 @if($errors->has('email'))
		                        @foreach($errors->get('email') as $err)
		                          <li class="text-info error"><div><p class="bg-danger">{{ $err }}</p></div></li>
		                        @endforeach
		                     @endif
						 </div>
						 <div class="formulario">
							 <label>{{ Lang::get('lang.register_password') }}: </label>
							 <input class="register-input form-control" type="password" name="password" value="">
							 @if($errors->has('password'))
		                        @foreach($errors->get('password') as $err)
		                          <li class="text-info error"><div><p class="bg-danger">{{ $err }}</p></div></li>
		                        @endforeach
		                     @endif
						 </div>
						 <div class="formulario">
							 <label>{{ Lang::get('lang.register_confirm_pass') }}:</label>
							 <input class="register-input form-control" type="password" name="password_confirmation" value="" data-toggle="popover" trigger="manual" data-title="{{ Lang::get('lang.attention') }}" data-content="{{ Lang::get('lang.passwords_confirmation') }}">
							 @if($errors->has('password_confirmation'))
		                        @foreach($errors->get('password_confirmation') as $err)
		                          <li class="text-info error"><div><p class="bg-danger">{{ $err }}</p></div></li>
		                        @endforeach
		                     @endif
						 </div>
						 <div class="formulario">
							 <label>{{ Lang::get('lang.register_address') }}:</label>
							 <input class="register-input form-control" type="text" name="address" value="{{ Input::old('address') }}">
							 @if($errors->has('address'))
		                        @foreach($errors->get('address') as $err)
		                          <li class="text-info error"><div><p class="bg-danger">{{ $err }}</p></div></li>
		                        @endforeach
		                     @endif
						 </div>						
						 <input type="submit" value="{{ Lang::get('lang.register_btn') }}" class="btn third">
						 <p class="click">{{ Lang::get('lang.register_text3') }}  <a href="#!">{{ Lang::get('lang.register_text4') }}.</a></p> 
					 </form>
				 </div>
			</div>
			<div class="col-xs-12 col-md-6 reg-right">
				 <h3 class="margin-top-1">Completely Free Account</h3>
				 <div class="strip"></div>
				 <p class="text-justify">Pellentesque neque leo, dictum sit amet accumsan non, dignissim ac mauris. Mauris rhoncus, lectus tincidunt tempus aliquam, odio 
				 libero tincidunt metus, sed euismod elit enim ut mi. Nulla porttitor et dolor sed condimentum. Praesent porttitor lorem dui, in pulvinar enim rhoncus vitae. Curabitur tincidunt, turpis ac lobortis hendrerit, ex elit vestibulum est, at faucibus erat ligula non neque.</p>
				 <h3 class="lorem">Lorem ipsum dolor.</h3>
				 <div class="strip"></div>
				 <p class="text-justify">Tincidunt metus, sed euismod elit enim ut mi. Nulla porttitor et dolor sed condimentum. Praesent porttitor lorem dui, in pulvinar enim rhoncus vitae. Curabitur tincidunt, turpis ac lobortis hendrerit, ex elit vestibulum est, at faucibus erat ligula non neque.</p>
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