<?php

class Wishlist extends Eloquent{
	public function items()
	{
		return $this->belongsTo('Item','item_id');
	}
	public function users()
	{
		return $this->belongsTo('User','user_id');
	}
}
