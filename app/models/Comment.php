<?php

class Comment extends Eloquent{
	public function users()
	{
		return $this->belongsTo('User','user_id');
	}
}
