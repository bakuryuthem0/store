<?php

class Factura extends Eloquent{
	public function compras()
	{
		return $this->hasMany('Compra','factura_id');
	}
	public function payments()
	{
		return $this->hasOne('Payment','factura_id');
	}
	public function users()
	{
		return $this->belongsTo('User','user_id');
	}
}
