<?php
	Class ShopType
	{
		function __construct() {
		}
		public static function getShopInfo()
		{
			$route = Request::url();
			$route = explode('.', $route);
			if (strpos($route[0], 'http://') == false) {
				$route[0] = str_replace('http://', '', $route[0]);
			}
			$info  = App::make('stores', $route[0]);
			return $info;
		}
		public static function validateShopTypeRules($storeType, $data)
		{
			switch ($storeType) {
				case 1:
					$aux = array();
					foreach ($data['size_es'] as $i => $v) {
						$aux['size_es.'.$i] = "required|min:1";
						$aux['size_eng.'.$i] = "required|min:1";
					}
					foreach ($data['color_es'] as $i => $v) {
						$aux['color_es.'.$i] = "required|min:1";
						$aux['color_eng.'.$i] = "required|min:1";
					}
					foreach ($data['fabric_es'] as $i => $v) {
						$aux['fabric_es.'.$i] = "required|min:1";
						$aux['fabric_eng.'.$i] = "required|min:1";
					}
					return $aux;
					break;
				default:
					break;
			}
		}
		public static function validateShopTypeAttr($storeType, $data)	
		{
			switch ($storeType) {
				case 1:
					$aux = array();
					foreach ($data['size_es'] as $i => $v) {
						$aux['size_es.'.$i] = "talla (español)";
						$aux['size_eng.'.$i] = "talla (ingles)";
					}
					foreach ($data['color_es'] as $i => $v) {
						$aux['colo_es.'.$i] = "color (español)";
						$aux['colo_eng.'.$i] = "color (ingles)";
					}
					foreach ($data['fabric_es'] as $i => $v) {
						$aux['fabric_es.'.$i] = "tela (español)";
						$aux['fabric_eng.'.$i] = "tela (ingles)";
					}
					return $aux;
					break;
				default:
					break;
			}
		}
		public static function saveProductDetails($storeType,$id,$data)
		{
			switch ($storeType) {
				case 1:
					foreach($data['color_es'] as $i => $c)
					{
						if (!empty($c)) 
						{
							$color = new Color;
							$color->item_id = $id;
							$color->description_es    = $c;
							$color->description_eng   = $data['color_eng'][$i];
							$color->save();
						}
					}
					foreach($data['size_es'] as $i => $s)
					{
						if (!empty($s)) 
						{
							$size = new Talla;
							$size->item_id = $id;
							$size->description_es    = $s;
							$size->description_eng   = $data['size_eng'][$i];
							$size->save();
						}
					}
					foreach($data['fabric_es'] as $i => $a)
					{
						if (!empty($a)) 
						{
							$acc = new Material;
							$acc->item_id = $id;
							$acc->description_es    = $a;
							$acc->description_eng   = $data['fabric_eng'][$i];
							$acc->save();
						}
					}
					break;
				
				default:
					break;
			}
		}
		public static function saveMdf($data, $id)
		{
			foreach ($data['size_es'] as $i => $s) {
				$size = Talla::find($i);
				if(is_null($size))
				{
					$size = new Talla;
					$size->item_id 			= $id;
					$size->description_es 	= $data['size_es'][$i];
					$size->description_eng 	= $data['size_eng'][$i];
				}else
				{
					$size->description_es 	= $data['size_es'][$i];
					$size->description_eng 	= $data['size_eng'][$i];
				}
				$size->save();
			}
			foreach ($data['color_es'] as $i => $c) {
				$color = Color::find($i);
				if(is_null($color))
				{
					$color = new Color;
					$color->item_id 			= $id;
					$color->description_es 		= $data['color_es'][$i];
					$color->description_eng 	= $data['color_eng'][$i];
				}else
				{
					$color->description_es 		= $data['color_es'][$i];
					$color->description_eng 	= $data['color_eng'][$i];
				}
				$color->save();
			}
			foreach ($data['fabric_es'] as $i => $a) {
				$fabric = Material::find($i);
				if(is_null($fabric))
				{
					$fabric = new Material;
					$fabric->item_id 			= $id;
					$fabric->description_es 	= $data['fabric_es'][$i];
					$fabric->description_eng 	= $data['fabric_eng'][$i];
				}else
				{
					$fabric->description_es 	= $data['fabric_es'][$i];
					$fabric->description_eng 	= $data['fabric_eng'][$i];
				}
				$fabric->save();
			}
		}
		public static function getLogo()
		{
			$info = ShopType::getShopInfo();
			return $info->store_logo;
		}

		//type 1
		public static function getTallas()
		{
			$tallas = Talla::groupBy('description_'.(Session::get('lang') ? Session::get('lang') : "es"))->get(array(
				'id',
				'description_'.(Session::get('lang') ? Session::get('lang') : "es").' as description',
			));
			return $tallas;
		}
		public static function getColores()
		{
			$color = Color::groupBy('description_'.(Session::get('lang') ? Session::get('lang') : "es"))->get(array(
				'id',
				'description_'.(Session::get('lang') ? Session::get('lang') : "es").' as description',
			));
			return $color;
		}
		public static function getMateriales()
		{
			$materiales = Material::groupBy('description_'.(Session::get('lang') ? Session::get('lang') : "es"))->get(array(
				'id',
				'description_'.(Session::get('lang') ? Session::get('lang') : "es").' as description',
			));
			return $materiales;
		}
		public static function filterByType($dataFilter, $items, &$sideBar)
		{
			$info = ShopType::getShopInfo();
			if ($info->store_type == 1) {
				if (isset($dataFilter['filter-size'])) {
					$items = $items->whereHas('tallas', function($query) use($dataFilter){
						$query->where('id','=',$dataFilter['filter-size']);
					});
					$sideBar = $sideBar->with('talla',$dataFilter['filter-size']);
				}
				if (isset($dataFilter['filter-color'])) {
					$items = $items->whereHas('colores', function($query) use($dataFilter){
						$query->where('id','=',$dataFilter['filter-color']);
					});
					$sideBar = $sideBar->with('color',$dataFilter['filter-color']);
				}
				if (isset($dataFilter['filter-fabric'])) {
					$items = $items->whereHas('materiales', function($query) use($dataFilter){
						$query->where('id','=',$dataFilter['filter-fabric']);
					});
					$sideBar = $sideBar->with('material',$dataFilter['filter-fabric']);
				}
			}
			return $items;
		}
	}