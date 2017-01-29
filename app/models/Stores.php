<?php

class Stores extends Eloquent{
	protected $connection = "tecnographic";
	protected $table 	  = "store_clients";
	public function banks()
	{
		return $this->hasMany('Bank','store_id');
	}

}
