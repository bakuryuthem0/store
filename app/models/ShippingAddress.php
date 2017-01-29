<?php

class ShippingAddress extends Eloquent{

	protected $table = "shipping_address";
	
	public function direcciones()
	{
		return $this->belongsTo('User','user_id');
	}
}
