@extends($store->template.'.layouts.default')

@section('content')

    <div class="product-big-title-area second">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>
							{{ Lang::get('lang.login_title') }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

<!-- content-section-starts -->
<div class="content mid-section">
	<div class="container">
		<div class="login-page">
	    	<div class="product-breadcroumb margin-top-1">
                <a href="{{ URL::to('/') }}">{{ Lang::get('lang.go_home_title') }}</a>
                <a href="#!">
					{{ Lang::get('lang.login_title') }}
                </a>
                <ul class="list-unstyled pull-right previous">
		        	<li><a href="{{ URL::previous() }}">{{ Lang::get('lang.get_back') }}</a></li>
		        </ul>
            </div>
		   <div class="row">
			    <div class="col-md-6 login-left wow fadeInLeft" data-wow-delay="0.4s">
					<h2>{{ Lang::get('lang.login_new_costumer') }}</h2>
					<p>{{ Lang::get('lang.login_text1') }}</p>
					<a class="btn third" href="{{ URL::to('inicio/registrese') }}">{{ Lang::get('lang.login_create_account') }}</a>
			    </div>
			    <div class="col-md-6 login-right wow fadeInRight" data-wow-delay="0.4s">
			  		<h3>{{ Lang::get('lang.registered_costumer') }}</h3>
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
					<p>{{ Lang::get('lang.login_text2') }}</p>
					<form method="POST" action="{{ URL::to('tienda/login/enviar') }}">
				  		<div class="formulario">
							<label>{{ Lang::get('lang.login_input1') }}<label>*</label></label>
							<input type="text" name="email" class="form-control"> 
					  	</div>
				  		<div class="formulario">
							<label>{{ Lang::get('lang.register_password') }}<label>*</label></label>
							<input type="password" name="password" class="form-control"> 
				  		</div>
      					{{ Form::token() }}
      					<div class="formulario">
					  		<a class="forgot" href="#">{{ Lang::get('lang.forgot_pass') }}</a>
					  		<input type="submit" value="Login" class="btn third">
      					</div>
		    		</form>
			    </div>	
			    <div class="clearfix"> </div>
		 	</div>
	   	</div>
	</div>
</div>
@stop