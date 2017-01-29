<?php

class Categoria extends Eloquent{
	public function subcat()
	{
		return $this->hasMany('SubCat','cat_id');
	}
}
