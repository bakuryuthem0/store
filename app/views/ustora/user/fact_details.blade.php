@extends($store->template.".layouts.default")

@section('content')
<div class="product-big-title-area second">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>
                    	{{ Lang::get('lang.fact_title') }}
                    </h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- checkout -->
<div class="cart-items mid-section">
	<div class="container">
		<div class="product-breadcroumb">
            <a href="{{ URL::to('/') }}">Home</a>
            <a href="#!">
               {{ Lang::get('lang.fact_title') }}
            </a>
            <ul class="list-unstyled pull-right previous">
	        	<li><a href="{{ URL::previous() }}">{{ Lang::get('lang.get_back') }}</a></li>
	        </ul>
        </div>
		<div class="cart-gd margin-top-1">
			@foreach($fact->compras as $c)
			<div class="row cart-header margin-top-1">
				 <div class="cart-sec simpleCart_shelfItem">
					<div class="col-xs-6 col-md-4 cart-item cyc">
						 <img src="{{ strpos($c->imagenes->first()->image, 'lorem') ? $c->imagenes->first()->image : asset('images/items/'.$c->imagenes->first()->image) }}" class="img-responsive item_img checkout_img" alt="">
					</div>
				    <div class="col-xs-6 col-md-4 no-padding cart-item-info">
				    	<div class="col-xs-12">
							<h3>
								<a href="#!" class="item_name">
									@if(!Session::has('lang') || Session::get('lang') == 'es')
										{{ $c->items->title_es }}
									@else
										{{ $c->items->title_eng }}
									@endif
								</a>
							</h3>
							<ul class="col-xs-12 no-padding qty list-unstyled formulario">
								<li><p>{{ Lang::get('lang.order_qty') }}: <span class="item_qty">{{ $c->qty }}</span></p></li>
								<li><p>{{ Lang::get('lang.price_unit') }}: <span class="item_price">{{ $c->items->price }}</span></p></li>
							</ul>
							<div class="col-xs-12 no-padding">
								<strong>Sub-total : <span class="item_sub_total text-success">{{ $c->qty*$c->items->price }}</span></strong>
								<div class="clearfix"></div>	
							  	<?php $total = $total+$c->qty*$c->items->price ?>
					        </div>
				    	</div>
				   </div>
			    	<div class="col-xs-12 col-md-4">
			    		<dl class="dl-horizontal">
			    			@if(!Session::has('lang') || Session::get('lang') == 'es')
								<dt>{{ Lang::get('lang.product_size') }}</dt>
							  	<dd class="item_size">{{ $c->tallas->description_es }}</dd>
							  	<dt>{{ Lang::get('lang.product_color') }}</dt>
							  	<dd class="item_color">{{ $c->colores->description_es }}</dd>
							  	<dt>{{ Lang::get('lang.product_fabric') }}</dt>
							  	<dd class="item_fabric">{{ $c->materiales->description_es }}</dd>
							@else
								<dt>{{ Lang::get('lang.product_size') }}</dt>
							  	<dd class="item_size">{{ $c->tallas->description_eng }}</dd>
							  	<dt>{{ Lang::get('lang.product_color') }}</dt>
							  	<dd class="item_color">{{ $c->colores->description_eng }}</dd>
							  	<dt>{{ Lang::get('lang.product_fabric') }}</dt>
							  	<dd class="item_fabric">{{ $c->materiales->description_eng }}</dd>
							@endif
						</dl>
			    	</div>
				   <div class="clearfix"></div>
			  	</div>
			</div>
			@endforeach
			@if($fact->was_paid == 0)
			<div class="row">
				<div class="col-xs-12 no-padding">
					<div class="col-xs-12 col-md-6">
						<h2 class="text-left">Total: <span class="text-success">{{ $total }}</span></h2>
					</div>
				</div>
			</div>
			<div class="panel-group margin-top-1" id="accordion" role="tablist" aria-multiselectable="true">
				<div class="panel panel-default">
				    <div class="panel-heading third" role="tab" id="headingOne">
				      <h4 class="panel-title">
				        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
				          Paypal
				        </a>
				      </h4>
				    </div>
				    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
				      <div class="panel-body">
				        @if(!empty($token))
		 					<div class="paypal">
								<script src="https://www.paypalobjects.com/api/button.js?"
							     data-merchant="braintree"
							     data-id="paypal-button"
							     data-button="checkout"
							     data-color="blue"
							     data-size="medium"
							     data-shape="pill"
							     data-button_type="submit"
							     data-button_disabled="false"
							 ></script>
							<!-- Configuration options:
							  data-color: "blue", "gold", "silver"
							  data-size: "tiny", "small", "medium"
							  data-shape: "pill", "rect"
							  data-button_disabled: "false", "true"
							  data-button_type: "submit", "button"
							-->
							</div>
						@endif
				      </div>
				    </div>
				</div>
				<div class="panel panel-default">
				    <div class="panel-heading third" role="tab" id="headingTwo">
				      <h4 class="panel-title">
				        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
				          {{ Lang::get('lang.transfer_or_deposit') }}
				        </a>
				      </h4>
				    </div>
				    <div id="collapseTwo" class="panel-collapse collapse @if(Input::old('fact_id')) in @endif" role="tabpanel" aria-labelledby="headingTwo">
				      <div class="panel-body">
				      	<form method="POST" action="{{ URL::to('tienda/usuario/factura/procesar/'.$fact->id) }}">
				      		<div class="formulario">
				      			<label>{{ Lang::get('lang.reference_number') }}</label>
				      			<input type="text" class="form-control" name="transaction_number" value="{{ Input::old('transaction_number') }}">
				      			@if($errors->has('transaction_number'))
				      			<div class="formulario">
			                    </div>
			                        @foreach($errors->get('transaction_number') as $err)
			                        	<div class="alert alert-danger">
			                        		{{ $err }}
			                        	</div>
			                        @endforeach
			                    @endif
				      		</div>
				      		<div class="formulario">
					      		<label>{{ Lang::get('lang.type_transaction') }}</label>
					      		<select class="form-control transfer_type" name="transaction_type">
					      			<option value="deposito" @if(Input::old('transaction_type') && Input::old('transaction_type') == "deposito") selected @endif>{{ Lang::get('lang.deposit') }}</option>
					      			<option value="transferencia" @if(Input::old('transaction_type') && Input::old('transaction_type') == 'transferencia') selected @endif>{{ Lang::get('lang.transfer') }}</option>
					      		</select>
					      		@if($errors->has('transaction_type'))
					      		<div class="formulario">
			                    </div>
			                        @foreach($errors->get('transaction_type') as $err)
			                        	<div class="alert alert-danger">
			                        		{{ $err }}
			                        	</div>
			                        @endforeach
			                    @endif
					      	</div>
					      	<div class="formulario transfer_type_container @if(!Input::old('transaction_type')) hidden @endif">
				      			<label>{{ Lang::get('lang.user_bank') }}</label>
					      		<select class="form-control emisor disabled" name="user_bank" @if(!Input::old('transaction_type')) disabled @endif>
				      				<option value="">{{ Lang::get('lang.select_an_option') }}</option>
				      				<option value="1" @if(Input::old('transaction_type') && Input::old('user_bank') == 1) selected @endif>Opcion 1</option>
				      				<option value="2" @if(Input::old('user_bank') && Input::old('user_bank') == 2) selected @endif>Opcion 2</option>
				      				<option value="3" @if(Input::old('user_bank') && Input::old('user_bank') == 3) selected @endif>Opcion 3</option>
					      		</select>
					      		@if($errors->has('user_bank'))
					      		<div class="formulario">
			                    </div>
			                        @foreach($errors->get('user_bank') as $err)
			                        	<div class="alert alert-danger">
			                        		{{ $err }}
			                        	</div>
			                        @endforeach
			                    @endif
					      	</div>
					      	<div class="formulario">
				      			<label>{{ Lang::get('lang.bank') }}</label>
				      			<select class="form-control" name="shop_bank">
				      				<option value="">{{ Lang::get('lang.select_an_option') }}</option>
				      				@foreach($banks as $b)
				      					<option value="{{ $b->id }}" @if(Input::old('shop_bank') && Input::old('shop_bank') == $b->id) selected @endif>{{ $b->name }}</option>
				      				@endforeach
				      			</select>
				      			@if($errors->has('shop_bank'))
				      			<div class="formulario">
			                    </div>
			                        @foreach($errors->get('shop_bank') as $err)
			                        	<div class="alert alert-danger">
			                        		{{ $err }}
			                        	</div>
			                        @endforeach
			                    @endif
				      		</div>
				      		<div class="formulario">
				      			<label>{{ Lang::get('lang.transaction_date') }}</label>
				      			<input type="text" class="datepicker form-control" name="transaction_date" value="{{ Input::old('transaction_date') }}">
				      			@if($errors->has('transaction_date'))
				      			<div class="formulario">
			                    </div>
			                        @foreach($errors->get('transaction_date') as $err)
			                        	<div class="alert alert-danger">
			                        		{{ $err }}
			                        	</div>
			                        @endforeach
			                    @endif
				      		</div>
				      		<div class="formulario">
				      			<input type="hidden" value="{{ $fact->id }}" name="fact_id">
				      			<button class="btn btn-primary">{{ Lang::get('lang.btn_send') }}</button>
				      		</div>
				      	</form>
				      </div>
				    </div>
				</div>
			</div>
			@else
			<div class="row">
				<div class="col-xs-12 no-padding">
					<div class="col-xs-12 col-md-6">
						<h2 class="text-left">Total: <span class="text-success">{{ $total }}</span></h2>
					</div>
				</div>
			</div>
			@endif
			@if(!Session::has('lang') || Session::get('lang') == 'es')
				<input type="hidden" class="name" value="{{ $c->items->title_es }}">
			@else
				<input type="hidden" class="name" value="{{ $c->items->title_eng }}">
			@endif
			<input type="hidden" class="amount" value="{{ $total }}">

		</div>
	</div>
</div>

<!-- //checkout -->	
@stop

@section('postscript')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/jquery-ui/jquery-ui.min.css') }}">
<script type="text/javascript" src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('.transfer_type').on('change', function(event) {
			if ($(this).val() == "transferencia") {
				$('.transfer_type_container').removeClass('hidden').children('.emisor').removeClass('disabled').attr('disabled', false);
			}else
			{
				$('.transfer_type_container').addClass('hidden').children('.emisor').removeClass('disabled').attr('disabled', true);
			}
		});
		$('.datepicker').datepicker({
			dateFormat: 'yy-mm-dd'
		});
	});
</script>
@if($token != "")
<script src="https://js.braintreegateway.com/web/3.3.0/js/client.min.js"></script>
<script src="https://js.braintreegateway.com/web/3.3.0/js/paypal.min.js"></script>
<script type="text/javascript">
	
	$(window).load(function() {
		// Fetch the button you are using to initiate the PayPal flow
		var paypalButton = document.getElementById('paypal-button');

		// Create a Client component
		braintree.client.create({
	  		authorization: <?php echo '\''.$token.'\''; ?>
		}, 
		function (clientErr, clientInstance) {
			console.log(clientErr);
			console.log(clientInstance);
			// Create PayPal component
		  	braintree.paypal.create({
		    	client: clientInstance
		  	}, 
		  	function (err, paypalInstance) {
		    	paypalButton.addEventListener('click', function () {
		      	// Tokenize here!
		      	paypalInstance.tokenize({
		        	flow: 'checkout', // Required
		        	amount: $('.amount').val(), // Required
		        	displayName: $('.name').val(),
		        	currency: 'USD', // Required
		        	locale: 'en_US',
		        	enableShippingAddress: true,
		        	shippingAddressEditable: false,
		        	shippingAddressOverride: {
		          		recipientName: <?php echo Auth::user()->name.' '.Auth::user()->lastname; ?>,
		          		line1: <?php echo $address; ?>,
		          		countryCode: 'US',
		          		postalCode: '60652',
		        	}
		      	}, 
		      	function (err, tokenizationPayload) {
		      		console.log(tokenizationPayload);
		        	// Tokenization complete
		        	// Send tokenizationPayload.nonce to server
		      	});
		    });
		  });
		});
	});
</script>
@endif
@stop