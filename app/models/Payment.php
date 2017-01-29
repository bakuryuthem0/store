<?php

class Payment extends Eloquent{
	public function banks()
	{
		return $this->belongsTo('Bank','shop_bank');
	}
}
