@extends($store->template.'.layouts.default')

@section('content')
<!-- content-section-starts -->
<div class="content">
	<div class="container">
		<div class="login-page">
	    	<div class="dreamcrub">
			    <ul class="breadcrumbs">
	                <li class="home">
	                   <a href="index.html" title="{{ Lang::get('lang.go_home_title') }}">{{ Lang::get('lang.home_title') }}</a>&nbsp;
	                   <span>&gt;</span>
	                </li>
	                <li class="women">
	                   {{ Lang::get('lang.login_title') }}
	                </li>
	            </ul>
	            <ul class="previous">
	            	<li><a href="{{ URL::previous() }}">{{ Lang::get('lang.get_back') }}</a></li>
	            </ul>
	            <div class="clearfix"></div>
		   </div>
		   <div class="account_grid">
			    <div class="col-md-6 login-left wow fadeInLeft" data-wow-delay="0.4s">
					<h2>{{ Lang::get('lang.login_new_costumer') }}</h2>
					<p>{{ Lang::get('lang.login_text1') }}</p>
					<a class="acount-btn third" href="{{ URL::to('inicio/registrese') }}">{{ Lang::get('lang.login_create_account') }}</a>
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
				  		<div>
							<span>{{ Lang::get('lang.login_input1') }}<label>*</label></span>
							<input type="text" name="email"> 
					  	</div>
				  		<div>
							<span>{{ Lang::get('lang.register_password') }}<label>*</label></span>
							<input type="password" name="password"> 
				  		</div>
      					{{ Form::token() }}
				  		<a class="forgot" href="#">{{ Lang::get('lang.forgot_pass') }}</a>
				  		<input type="submit" value="Login" class="third">
		    		</form>
			    </div>	
			    <div class="clearfix"> </div>
		 	</div>
	   	</div>
	</div>
</div>
@stop