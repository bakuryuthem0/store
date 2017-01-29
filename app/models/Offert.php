<?php

class Offert extends Eloquent{
	public function offertItems()
	{
		return $this->hasMany('OffertItem','offert_id');
	}
	public function offertItemCount()
	{
		return $this->offertItems()
	    ->selectRaw('offert_id,count(*) as aggregate')
	    ->groupBy('offert_id');;
	}
}
