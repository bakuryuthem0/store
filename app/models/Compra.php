<?php

class Compra extends Eloquent{
	public function items()
	{
		return $this->belongsTo('Item','item_id');
	}
	public function tallas()
	{
		return $this->belongsTo('Talla','size_id');
	}
	public function colores()
	{
		return $this->belongsTo('Color','color_id');
	}
	public function materiales()
	{
		return $this->belongsTo('Material','fabric_id');
	}
	public function facturas()
	{
		return $this->belongsTo('Factura','factura_id');
	}
	public function imagenes()
	{
		return $this->belongsTo('ItemImage','item_id');
	}
}
