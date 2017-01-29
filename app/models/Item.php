<?php

class Item extends Eloquent{
	use Conner\Tagging\TaggableTrait;
	
	public function offertItem()
	{
		return $this->hasMany('OffertItem','item_id');
	}
	public function tallas()
	{
		return $this->hasMany('Talla','item_id');
	}
	public function colores()
	{
		return $this->hasMany('Color','item_id');
	}
	public function materiales()
	{
		return $this->hasMany('Material','item_id');
	}
	public function categoria()
	{
		return $this->belongsTo('Categoria','cat_id');
	}
	public function subcategoria()
	{
		return $this->belongsTo('SubCat','sub_cat_id');
	}
	public function imagenes()
	{
		return $this->hasMany('ItemImage','item_id');
	}
	public function tags()
	{
		return $this->hasMany('Tags','taggable_id');
	}
	public function wishlist()
	{
		return $this->hasOne('Wishlist','item_id');
	}
}
