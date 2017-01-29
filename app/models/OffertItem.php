<?php

class OffertItem extends Eloquent{
	public function offerts()
	{
		return $this->belongsTo('Offert','offert_id');
	}
	public function items()
	{
		return $this->belongsTo('Item','item_id');
	}
}
