<?php

class LastLogin extends Eloquent{
	protected $table = "last_login";

	public function visit()
	{
		return $this->belongTo('User','user_id');
	}
}
