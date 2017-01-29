<?php

class ShopController extends BaseController {

	public function getInfo($subdomain)
	{
		return App::make('stores', $subdomain); 
	}

	public function getNewItem($subdomain)
	{
		$title = "Nuevo producto | nombredelapagina";
		$cat   = Categoria::get();
		return View::make('admin.items.new')
		->with('title',$title)
		->with('cat',$cat)
		->with('store',$this->getInfo($subdomain));
	}
	public function getSubCat()
	{
		if (Request::ajax()) {
			$cat_id = Input::get('cat_id');
			$subCat = SubCat::where('cat_id','=',$cat_id)->get();
			return Response::json(array(
				'type' => 'success',
				'data' => $subCat,
			));
		}
		return Response::json(array('type' => 'danger','msg' => 'Error 403'));
	}
	public function postNewItem($subdomain)
	{
		$data 	= Input::all();
		$shop_type_rules = ShopType::validateShopTypeRules($this->getInfo($subdomain)->store_type, $data); 
		$shop_type_attr = ShopType::validateShopTypeAttr($this->getInfo($subdomain)->store_type, $data);
		$aux =  ImageController::imageValidation($data);
		$img_rules = $aux['rules'];
		$img_attr  = $aux['attr'];
		$rules 	= array_merge(array(
				'title_es'    		=> 'required|min:4|max:100',
				'title_eng'    		=> 'required|min:4|max:100',
				'category'			=> 'required|exists:categorias,id',
				'sub-category'		=> 'required|exists:sub_categorias,id',
				'price'				=> 'required|numeric',
				'stock'				=> 'required|numeric|min:1',
				'description_es'	=> 'required|max:1500',
				'description_eng' 	=> 'required|max:1500',
				'img.0'				=> 'required',
			),
			$shop_type_rules,
			$img_rules
		);
		$msg 	= array(
		);
		$attr 	= array_merge(array(
				'title_es'			=> 'titulo (español)',
				'title_eng'			=> 'titulo (ingles)',
				'category'			=> 'categoría',
				'sub-category'		=> 'sub-categoría',
				'price'   			=> 'precio',
				'stock'   			=> 'inventario',
				'description_es'	=> 'descripción (español)',
				'description_eng'	=> 'descripción (ingles)',
				'img.0'				=> 'imagen',
			),
			$shop_type_attr,
			$img_attr
		);
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$item = new Item;
		$item->title_es    = $data['title_es'];
		$item->title_eng   = $data['title_eng'];
		$item->cat_id  	   = $data['category'];
		$item->sub_cat_id  = $data['sub-category'];
		$item->price   	   = $data['price'];
		$item->stock 	   = $data['stock'];
		$item->description_es 	= $data['description_es'];
		$item->description_eng 	= $data['description_eng'];
		$item->save();
		foreach ($data['tag_es'] as $key => $value) {
			$data['tag_es'][$key] = $data['tag_es'][$key].'.es'; 
		}
		foreach ($data['tag_eng'] as $key => $value) {
			$data['tag_eng'][$key] = $data['tag_eng'][$key].'.eng'; 
		}
		$tags = array_merge($data['tag_es'],$data['tag_eng']);
		$item->retag($tags);
		$id = $item->id;

		ShopType::saveProductDetails($this->getInfo($subdomain)->store_type, $id, $data); 

		$file = Input::file();
		foreach($file['img'] as $f)
		{
			$img = new ItemImage;
			$img->item_id = $id;
			$img->image   = ImageController::upload_image($f,$f->getClientOriginalName(),'images/items');
			$img = Intervention::make('images/items/'.$img->image);
	        if ($img->width() > 2880) {
	        	$img->widen(2880);
	        }
	        $mark = Intervention::make('images/watermark.png')->widen(400);
            
	        $img->insert($mark,'center')
           	->interlace()
            ->save('images/items/'.$img->image);
			$img->save();
		}
		Session::flash('success','Producto creado satisfactoriamente.');
		return Redirect::to('administrador/ver-productos');

	}
	public function getProducts($subdomain)
	{
		$title = "Ver productos | nombredelapagina";
		$items = Item::get();
		return View::make('admin.items.showItems')
		->with('title',$title)
		->with('items',$items)
		->with('store',$this->getInfo($subdomain));
	}
	public function getItemInfo($subdomain)
	{
		$store = $this->getInfo($subdomain);	
		$id = Input::get('id');
		if ($store->store_type == 1) {
			$item = Item::with('categoria')->with('subcategoria')->with('tallas')->with('colores')->with('materiales')->where('id','=',$id)->first();
		}
		return Response::json(array(
			'type' => 'success',
			'data' => $item,
			'store_type' => $store->store_type,
		));
	}
	public function getItem($subdomain, $id)
	{
		$item = Item::with('tags')->with('colores')->with('tallas')->with('materiales')->with('imagenes')->where('id','=',$id)->first();
		$title = 'Modificar producto: '.$item->title.' | nombredelapagina';
		$cat   = Categoria::get();
		$subcat= SubCat::where('cat_id','=',$item->cat_id)->get();
		return View::make('admin.items.mdfItem')
		->with('item',$item)
		->with('title',$title)
		->with('cat',$cat)
		->with('subcat',$subcat)
		->with('store',$this->getInfo($subdomain));
	}
	public function postMdfItem($subdomain, $id)
	{
		$data = Input::all();
		$shop_type_rules = ShopType::validateShopTypeRules($this->getInfo($subdomain)->store_type, $data); 
		$shop_type_attr = ShopType::validateShopTypeAttr($this->getInfo($subdomain)->store_type, $data);
		$aux =  ImageController::imageValidation($data);
		$img_rules = $aux['rules'];
		$img_attr  = $aux['attr'];
		$rules 	= array_merge(array(
				'title_es'    		=> 'required|min:4|max:100',
				'title_eng'    		=> 'required|min:4|max:100',
				'category'			=> 'required|exists:categorias,id',
				'sub-category'		=> 'required|exists:sub_categorias,id',
				'price'				=> 'required|numeric',
				'stock'				=> 'required|numeric|min:1',
				'description_es'	=> 'required|max:1500',
				'description_eng' 	=> 'required|max:1500',
			),
			$shop_type_rules,
			$img_rules
		);
		$msg 	= array(
		);
		$attr 	= array_merge(array(
				'title_es'			=> 'titulo (español)',
				'title_eng'			=> 'titulo (ingles)',
				'category'			=> 'categoría',
				'sub-category'		=> 'sub-categoría',
				'price'   			=> 'precio',
				'stock'   			=> 'inventario',
				'description_es'	=> 'descripción (español)',
				'description_eng'	=> 'descripción (ingles)',
			),
			$shop_type_attr,
			$img_attr
		);
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return $validator->getMessageBag();
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$item = Item::find($id);
		$item->title_es    = $data['title_es'];
		$item->title_eng   = $data['title_eng'];
		$item->cat_id  	   = $data['category'];
		$item->sub_cat_id  = $data['sub-category'];
		$item->price   	   = $data['price'];
		$item->stock 	   = $data['stock'];
		$item->description_es 	= $data['description_es'];
		$item->description_eng 	= $data['description_eng'];
		$item->save();
		if (Input::has('tag_es')) {
			foreach ($data['tag_es'] as $key => $value) {
				$data['tag_es'][$key] = $data['tag_es'][$key].'.es'; 
			}
		}
		if (Input::has('tag_eng')) {
			foreach ($data['tag_eng'] as $key => $value) {
				$data['tag_eng'][$key] = $data['tag_eng'][$key].'.eng'; 
			}
		}
		if (Input::has('tag_es') && Input::has('tag_eng')) {
			$tags = array_merge($data['tag_es'],$data['tag_eng']);
			$item->retag($tags);
		}
		ShopType::saveMdf($data, $item->id);
		$file = Input::file();
		if (Input::hasFile('img')) {
			foreach($file['img'] as $i => $f)
			{
				$img = ItemImage::find($i);
				if (is_null($img)) {
					$img = new ItemImage;
					$img->item_id = $item->id;
				}else
				{
					File::delete('images/items/'.$img->image);
				}
				$img->image   = ImageController::upload_image($f,$f->getClientOriginalName(),'images/items');
				$img->save();
			}
		}

		Session::flash('success', 'Se ha modificado el producto satisfactoriamente.');
		return Redirect::back();
	}
	public function postElimItem()
	{
		$id = Input::get('id');
		$size = Talla::where('item_id','=',$id)->delete();
		$acc  = Material::where('item_id','=',$id)->delete();
		$colo = Color::where('item_id','=',$id)->delete();

		$aux  = ItemImage::where('item_id','=',$id);
		$img  = $aux->get();
		foreach ($img as $i) {
			File::delete('images/items/'.$i->image);
		}
		$aux->delete();
		$item = Item::find($id)->delete();
		return Response::json(array(
			'type' => 'success',
			'msg'  => 'Se ha borrado el producto satisfactoriamente.'
		));

	}
	public function elimImg()
	{
		$id = Input::get('id');
		$i  = ItemImg::find($id);
		File::delete('images/items/'.$i->image);
		$aux = Img::where('id','=',$id)->delete();
		return Response::json(array(
			'type' => 'success',
			'msg'  => 'Se ha borrado la imagen satisfactoriamente.',
		));
	}
	public function postElimColor()
	{
		$id = Input::get('id');
		$aux = Color::where('id','=',$id)->delete();
		return Response::json(array(
			'type' => 'success',
			'msg'  => 'Se ha borrado el color satisfactoriamente.',
		));
	}
	public function postElimSize()
	{
		$id = Input::get('id');
		$aux = Talla::where('id','=',$id)->delete();
		return Response::json(array(
			'type' => 'success',
			'msg'  => 'Se ha borrado la talla satisfactoriamente.',
		));
	}
	public function postElimFabric($value='')
	{
		$id = Input::get('id');
		$aux = Material::where('id','=',$id)->delete();
		return Response::json(array(
			'type' => 'success',
			'msg'  => 'Se ha borrado el material satisfactoriamente.',
		));
	}

	public function postProceed()
	{
		$data = Input::all();
		$dataCreate = array();
		$factura = new Factura;
		$factura->user_id = Auth::id();
		$factura->save();
		foreach ($data['item_product'] as $id => $v) {
			$compra = new Compra;
			$compra->factura_id		= $factura->id;
			$compra->item_id 		= $v;
			$compra->size_id	 	= $data['item_size'][$v];
			$compra->color_id	 	= $data['item_color'][$v];
			$compra->fabric_id	 	= $data['item_fabric'][$v];
			$compra->qty	 		= $data['item_qty'][$v];
			$compra->save();
		}
		Session::flash('success','Se ha creado su factura satisfactoriamente.');
		return Redirect::to('tienda/usuario/mis-compras');
	}
	public function getUserFact($subdomain)
	{
		$store = $this->getInfo($subdomain);
		$fact = Factura::with(array('compras' => function($query){
			$query->with('items')->with('tallas')->with('colores')->with('materiales');
		}))
		->where('user_id','=',Auth::id())
		->where('canceled','=',0)
		->get();
		
		$title = Lang::get('lang.fact_title')." | nombredelapagina";

		return View::make($store->template.'.user.fact')
		->with('title',$title)
		->with('fact',$fact)
		->with('store',$store)
		->with('total',$total = 0);
	}
	public function getUserFactDetails($subdomain, $id)
	{
		$token = array(
		    'accessToken' => 'access_token$sandbox$wrg98gwftxkpbt39$4a671460d1d09552f7d047f85c754b0a',
		);
		/*if($gateway = new Braintree_Gateway($token))
		{
			$clientToken = $gateway->clientToken()->generate();
		}*/
		$clientToken = "";
		$store = $this->getInfo($subdomain);

		$fact = Factura::with(arraY('compras' => function($query){
			$query->with('items')->with('tallas')->with('colores')->with('materiales')->with('imagenes');
		}))
		->where('user_id','=',Auth::id())
		->where('canceled','=',0)
		->where('id','=',$id)
		->first();
		$title = Lang::get('lang.fact_title')." | nombredelapagina";

		$address = ShippingAddress::where('user_id','=',Auth::id())->where('is_default','=',1)->first();

		$banks = Bank::where('store_id','=',$store->id)->get();

		return View::make($store->template.'.user.fact_details')
		->with('title',$title)
		->with('fact',$fact)
		->with('store',$store)
		->with('total',$total = 0)
		->with('address',$address)
		->with('banks',$banks)
		->with('token',$clientToken);
	}
	public function getSearch($subdomain)
	{
		$busq = Input::get('busq');
		$data = Input::all();
		$store = $this->getInfo($subdomain);
		$hasFilter = 0;
		$items = Item::with('imagenes')
		->with(array('offertItem' => function($query){
     		$query->with('offerts');
     	}))->with('categoria')
		->where(function($query) use($busq){
			$query->where(Session::get('lang') ? 'title_'.Session::get('lang') : 'title_es','LIKE',$busq.'%')
			->orWhere(Session::get('lang') ? 'title_'.Session::get('lang') : 'title_es','LIKE','%'.$busq.'%')
			->orWhere(Session::get('lang') ? 'title_'.Session::get('lang') : 'title_es','LIKE','%'.$busq);

		});
		$paginatorFilter = '';
		$sideBar = View::make($store->template.'.partials.sideMenu')
		->with('store',$store)
		->with('busq',isset($busq) ? $busq : "")
		->with('cat_title',Lang::get('lang.category'))
		->with('cat_type','categoria')
		->with('cat_list',Categoria::get());

		$items = ShopType::filterByType($data, $items, $sideBar);
		if (Input::has('min') || Input::has('max'))
		{
			$min = Input::get('min');
			$max = Input::get('max');
			if (!is_null($min) && !is_null($max) && !empty($min) && !empty($max)) {
				$minmax = array($min, $max);
				$paginatorFilter .= '&min='.$min.'&max='.$max;
				$items =  $items->where('price','>=',$min)->where('price','<=',$max);
				$sideBar = $sideBar->with('min',$min)->with('max',$max);
			}else{
				if(!is_null($max) && !empty($max)){
					$paginatorFilter .= '&max='.$max;
					$items =  $items->where('price','<=',$max);
					$sideBar = $sideBar->with('max',$max);

				}elseif(!is_null($min) && !empty($min)){
					$paginatorFilter .= '&min='.$min;
					$items =  $items->where('price','>=',$min);
					$sideBar = $sideBar->with('min',$min);
				}
			}
		}
		$title = Lang::get('lang.busq_filter').$busq." | nombredelapagina";
		
		$view = View::make($store->template.'.search.cat')
		->with('title',$title)
		->with('store',$store);

		if (Input::has('sort_type')) {
			$sort_type 	= Input::get('sort_type');
			$sort_by 	= Input::get('sort_by');

			$items = $items->orderBy($sort_type,$sort_by);
			$view = $view->with('sort_type',$sort_type)->with('sort_by',$sort_by);
			$paginatorFilter .= '&sort_type='.$sort_type.'&sort_by='.$sort_by;
		}
		if (isset($busq)) {
			$view = $view->with('busq',$busq);
		}
		if(Input::has('paginate_number'))
		{
			$int = Input::get('paginate_number');
			$items = $items->orderBy('id','DESC')->paginate($int);
			$view = $view->with('paginate_number',$int);
			$paginatorFilter .= '&paginate_number='.$int;
		}else
		{
			$items = $items->orderBy('id','DESC')->paginate(6);
		}		
		$sideBar = $sideBar->with('paginatorFilter',$paginatorFilter);
		return $view->with('items',$items)
		->with('paginatorFilter',$paginatorFilter)
		->with('sideBar',$sideBar);
	}
	public function getItemsByCat($subdomain,$type, $id)
	{
		$store = $this->getInfo($subdomain);
		$data = Input::all();
		$hasFilter = 0;
		$sideBar = View::make($store->template.'.partials.sideMenu')
		->with('store',$store);
		$paginatorFilter = '';

		$items = Item::with('imagenes')->with('categoria');
		
		if ($type == "categoria") {
			$cat = Categoria::find($id);
			$cat_list = Categoria::get();
			$items = $items->where('cat_id','=',$id);
			$sideBar = $sideBar
			->with('cat_title',Lang::get('lang.category'))
			->with('cat_type','categoria')
			->with('cat_list',$cat_list)
			->with('active',$id);
		}elseif($type == "subcategoria")
		{
			$cat = SubCat::find($id);
			$cat_list = SubCat::where('menu_active','=',1)->get();
			$items = $items->where('sub_cat_id','=',$id);
			$sideBar = $sideBar
			->with('cat_title',Lang::get('lang.subcategory'))
			->with('cat_type','subcategoria')
			->with('cat_list',$cat_list)
			->with('active',$id);
		}elseif($type == "marcas")
		{
			$cat = Brand::find($id);
			$cat_list = Brand::get();
			$items = $items->where('brand_id','=',$id);
			$sideBar = $sideBar
			->with('cat_title',Lang::get('lang.brands'))
			->with('cat_type','marcas')
			->with('cat_list',$cat_list)
			->with('active',$id);
		}
		$items = ShopType::filterByType($data, $items, $sideBar);
		if (Input::has('min') || Input::has('max'))
		{
			$min = Input::get('min');
			$max = Input::get('max');
			if (!is_null($min) && !is_null($max) && !empty($min) && !empty($max)) {
				$minmax = array($min, $max);
				$paginatorFilter .= '&min='.$min.'&max='.$max;
				$items =  $items->where('price','>=',$min)->where('price','<=',$max);
				$sideBar = $sideBar->with('min',$min)->with('max',$max);
			}else{
				if(!is_null($max) && !empty($max)){
					$paginatorFilter .= '&max='.$max;
					$items =  $items->where('price','<=',$max);
					$sideBar = $sideBar->with('max',$max);

				}elseif(!is_null($min) && !empty($min)){
					$paginatorFilter .= '&min='.$min;
					$items =  $items->where('price','>=',$min);
					$sideBar = $sideBar->with('min',$min);
				}
			}
		}
		if (!Session::has('lang') || Session::get('lang') == 'es') {
			$title = Lang::get('lang.cat_filter').$cat->description_es." | nombredelapagina";
		}else
		{
			$title = Lang::get('lang.cat_filter').$cat->description_eng." | nombredelapagina";
		}

		$view = View::make($store->template.'.search.cat')
		->with('title',$title)
		->with('store',$store);

		if (Input::has('sort_type')) {
			$sort_type 	= Input::get('sort_type');
			$sort_by 	= Input::get('sort_by');

			$items = $items->orderBy($sort_type,$sort_by);
			$view = $view->with('sort_type',$sort_type)->with('sort_by',$sort_by);
			$paginatorFilter .= '&sort_type='.$sort_type.'&sort_by='.$sort_by;
		}

		if(Input::has('paginate_number'))
		{
			$int = Input::get('paginate_number');
			$items = $items->paginate($int);
			$view = $view->with('paginate_number',$int);
			$paginatorFilter .= '&paginate_number='.$int;
		}else
		{
			$items = $items->paginate(6);
		}		
		return $view
		->with('items',$items)
		->with('paginatorFilter',$paginatorFilter)
		->with('sideBar',$sideBar);
	}
	public function getFav()
	{
		$id = Input::get('id');
		$fav = Wishlist::where('item_id','=',$id)->where('user_id','=',Auth::id())->first();
		if (!is_null($fav) || !empty($fav)) {
			$fav->delete();
			return Response::json(array('type' => 'success','msg' => Lang::get('lang.removed_wishlist')));
		}
		$fav = new Wishlist;
		$fav->user_id = Auth::id();
		$fav->item_id = $id;
		$fav->save();
		return Response::json(array('type' => 'success', 'msg' => Lang::get('lang.item_added')));
	}
	public function getMyWishlist($subdomain)
	{
		$title = Lang::get('lang.my_wishlist')." | nombredelapagina";

		$store = $this->getInfo($subdomain);

		$wishlist = Wishlist::where('user_id','=',Auth::id());
		if ($store->store_type == 1) {
			$wishlist = $wishlist->with(array('items' => function($query){
				$query->with('imagenes')->with('tallas')->with('colores')->with('materiales');
			}));
		}
		$wishlist = $wishlist->get();
		return View::make($store->template.'.user.wishlist')
		->with('store',$store)
		->with('title',$title)
		->with('wishlist',$wishlist);
	}
	public function changeGrid($subdomain, $grid)
	{
		if (Session::has('show-type')) {
			Session::put('show-type',$grid);
		}else
		{
			Session::set('show-type',$grid);
		}
		return Response::json(array('type' => 'success'));
	}
	public function postUserFact()
	{
		$data 	= Input::all();
		$rules 	= array(
			'fact_id'				=> 'required',
			'transaction_number' 	=> 'required',
			'transaction_type' 	 	=> 'required',
			'user_bank' 			=> 'required_if:transaction_type,transferencia',
			'shop_bank'				=> 'required',
			'transaction_date'		=> 'required|date|max:'.date('Y-m-d',time()),
		);
		$msg = array();
		$attr = array(
			'fact_id'			 => Lang::get('lang.bill_id'),
			'transaction_number' => Lang::get('lang.reference_number'),
			'transaction_type'	 => Lang::get('lang.type_transaction'),
			'user_bank'			 => Lang::get('lang.user_bank'),
			'shop_bank'			 => Lang::get('lang.bank'),
			'transaction_date'	 => Lang::get('lang.transaction_date')
		);
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$fact = Factura::find($data['fact_id']);
		$fact->was_paid = 1;
		$fact->save();

		$payment = new Payment;
		$payment->factura_id 		    = $data['fact_id'];
		$payment->reference_number 		= $data['transaction_number'];
		$payment->transaction_method 	= $data['transaction_type'];
		$payment->shop_bank 			= $data['shop_bank'];
		if (Input::has('user_bank')) {
			$payment->user_bank				= $data['user_bank'];
		}
		$payment->transaction_date		= $data['transaction_date'];
		$payment->save();
		Session::flash('success', Lang::get('lang.success_payment'));
		return Redirect::to('tienda/usuario/mis-compras');
	}
	public function getBanner()
	{
		$store = ShopType::getShopInfo();
		$title = "Nuevo / Editar Banner | ".$store->store_name;

		return View::make('admin.store.banner.index')
		->with('title',$title)
		->with('store',$store);
	}
	public function postBanner($subdomain)
	{
		$data = Input::all();
		$rules = array(
			'file' => 'required|image|max:3000'
		);
		$msg = array();
		$attr = array('file' => 'banner');
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$store = Stores::where('subdomain','=',$subdomain)->first();
		$file = Input::file('file');
		$imgName = ImageController::upload_image($file,$file->getClientOriginalName(),'template/'.$store->template.'/images/banner/');
		$img = Intervention::make('template/'.$store->template.'/images/banner/'.$imgName);
		$img->interlace()
		->save();
		$store->store_banner = $imgName;
		$store->save();
		Session::flash('success','Se ha actualizado el banner principal satisfactoriamente.');
		return Redirect::back();
	}
	public function getNewOffert()
	{
		$store = ShopType::getShopInfo();
		$title = "Nueva Oferta | ".$store->store_name;
		$items = DB::table('items')->where('stock','>',0)->whereRaw('id NOT IN (select item_id FROM offert_items)')->get();
		return View::make('admin.offerts.new')
		->with('store',$store)
		->with('title',$title)
		->with('items',$items);
	}
	public function postNewOffert()
	{
		Validator::extend('required_if_exists', function($attribute, $value, $parameters)
		{
		    return isset($value);
		});
		$data  = Input::all();
		$rules = array(
			'title_es' 		=> 'required',
			'title_eng'		=> 'required',
			'percent'		=> 'required|numeric|min:1|max:100',
			'item_id'		=> 'required|min:1',
		);
		$msg  = array(
		);
		$attr = array(
			'title_es'		=> 'título en español',
			'title_es'		=> 'título en ingles',
		);
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$offert = new Offert;
		$offert->title_es 		= $data['title_es'];
		$offert->title_eng 		= $data['title_eng'];
		if (isset($data['subtitle_es'])) {
			$offert->subtitle_es 	= $data['subtitle_es'];
		}
		if (isset($data['subtitle_eng'])) {
			$offert->subtitle_eng 	= $data['subtitle_eng'];
		}
		$offert->percent 		= $data['percent'];
		if($offert->save())
		{
			foreach ($data['item_id'] as $id) {
				$item = new OffertItem;
				$item->offert_id 	= $offert->id; 
				$item->item_id 		= $id;
				$item->save();
			}
		}
		Session::flash('success','Se ha creado la oferta satisfactoriamente.');
		return Redirect::back();
	}
	public function getOfferts()
	{
		$store = ShopType::getShopInfo();
		$title = "Ver Ofertas | ".$store->store_name;
		$offerts = Offert::with('offertItemCount')->with(array('offertItems' => function($query){
			$query->with('items');
		}))->get();
		return View::make('admin.offerts.show')
		->with('offerts',$offerts)
		->with('title',$title)
		->with('store',$store);
	}
	public function postElimOffert()
	{
		$id = Input::get('id');
		$itemOffert = OffertItem::where('offert_id','=',$id)->delete();
		$offert = Offert::find($id)->delete();
		return Response::json(array(
			'type'  => 'success',
			'msg'	=> 'Se ha eliminado la oferta satisfactoriamente.'
		));
	}
	public function postRemoveItem()
	{
		$id = Input::get('id');
		$item = OffertItem::find($id)->delete();
		return Response::json(array(
			'type'  => 'success',
			'msg'	=> 'Se ha removido el item de la oferta satisfactoriamente.'
		));

	}
}