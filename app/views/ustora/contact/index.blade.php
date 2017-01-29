@extends($store->template.'.layouts.default')

@section('content')
<div class="product-big-title-area second">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>
                    	{{ Lang::get('lang.find_us') }}
                    </h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- contact-page -->
<div class="contact">
	<div class="container mid-section">
		<div class="product-breadcroumb">
            <a href="{{ URL::to('/') }}">Home</a>
            <a href="#!">
               {{ strtolower(Lang::get('lang.find_us')) }}
            </a>
            <ul class="list-unstyled pull-right previous">
	        	<li><a href="{{ URL::previous() }}">{{ Lang::get('lang.get_back') }}</a></li>
	        </ul>
        </div>
		
		<div class="contact-form">

			<div class="contact-info">
				<h3>{{ lang::get('lang.contact_form') }}</h3>

			</div>
			<form>
				<div class="col-xs-12 col-md-6 contact-left">
					<div class="formulario">
						<label>{{ Lang::get('lang.contact_name') }}</label>
						<input type="text" class="form-control" placeholder="" required>
					</div>
					<div class="formulario">
						<label>E-mail</label>
						<input type="text" class="form-control" placeholder="" required>
					</div>
					<div class="formulario">
						<label>{{ Lang::get('lang.contact_subject') }}</label>
						<input type="text" class="form-control" placeholder="" required>
					</div>
				</div>
				<div class="col-xs-12 col-md-6 contact-right">
					<label>{{ Lang::get('lang.contact_msg') }}</label>
					<textarea class="form-control" placeholder="" required></textarea>
				</div>
				<div class="clearfix"></div>
				<input type="submit" value="{{ Lang::get('lang.btn_submit') }}">
			</form>
		</div>
	</div>
	<div class="no-padding contact-map">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6632.248000703498!2d151.265683!3d-33.7832959!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b12abc7edcbeb07%3A0x5017d681632bfc0!2sManly+Vale+NSW+2093%2C+Australia!5e0!3m2!1sen!2sin!4v1433329298259" style="border:0"></iframe>
	</div>
</div>
<!-- //contact-page -->
@stop