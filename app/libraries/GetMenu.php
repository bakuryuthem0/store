<?php
	Class GetMenu
	{
		public static function getMenuCat()
		{
			$cat	= Categoria::with(array('subcat' => function($query)
			{
			     $query->where('menu_active', 1);
	     	}))->where('menu_active','=',1)->get();
	     	return $cat;
		}
		public static function getFooterCat()
		{
			$footerCat = Categoria::where(function($query){
	     		$query->where('menu_active','=',1)
	     		->orWhere('menu_active','=',0);
	     	})->take(9)->get();
	     	return $footerCat;
		}
	}