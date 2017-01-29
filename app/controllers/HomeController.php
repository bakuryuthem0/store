<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	public function getInfo($subdomain)
	{
		return App::make('stores', $subdomain); 
	}
	public function getIndex($subdomain)
	{
		$store 	= $this->getInfo($subdomain);

     	$items = Item::with('imagenes')->with(array('offertItem' => function($query){
     		$query->with('offerts');
     	}))->orderBy('id','DESC')->take(9)->get();
     	$brands = Brand::get();
		$title = Lang::get('lang.home_title')." | nombredelapagina";
		return View::make($store->template.'.home.index')
		->with('title',$title)
		->with('items',$items)
		->with('brands',$brands)
		->with('store',$store);
	}

	public function getItemSelf($subdomain, $id)
	{
		$store 	= $this->getInfo($subdomain);
		$sideBar = View::make($store->template.'.partials.sideMenu')
		->with('store',$store)
		->with('self','tiene')
		->with('cat_title',Lang::get('lang.category'))
		->with('cat_type','categoria')
		->with('cat_list',Categoria::get());
		
		$item = Item::with(array('tags' => function($query){
			$query->where('tag_name','like','%'.(!Session::has('lang') ? 'es' : Session::get('lang').'%'));
		}))
		->with('wishlist')
		->with('categoria')
		->with('subcategoria')
		->with('imagenes')
		->with('tallas')
		->with('colores')
		->with('materiales')
		->find($id);

		$related = Item::with('imagenes')->where('id','!=',$id)->where('cat_id','=',$item->cat_id)->where('sub_cat_id','=',$item->sub_cat_id)->take(3)->get();
		if (!Session::has('lang') || Session::get('lang') == 'es') {
			$title = $item->title_es;
		}else
		{
			$title = $item->title_eng;
		}
		$comments = Comment::with('users')
		->where('item_id','=',$id)
		->orderBy('id','DESC')
		->get();
		$title  = $title." | nombredelapagina";
		return View::make($store->template.'.items.self')
		->with('item',$item)
		->with('title',$title)
		->with('related',$related)
		->with('store',$store)
		->with('sideBar',$sideBar)
		->with('comments',$comments);
	}
	public function getCheckout($subdomain)
	{
		$store 	= $this->getInfo($subdomain);
		$title = " | nombredelapagina";
		return View::make($store->template.".items.checkout")
		->with('title',$title)
		->with('store',$store);
	}

	public function getSize($subdomain, $id)
	{
		$size = Talla::find($id);
		if (!Session::has('lang') || Session::get('lang') == 'es') {
			return Response::json(array('data' => $size->description_es));
		}else
		{
			return Response::json(array('data' => $size->description_eng));
		}
	}
	public function getColor($subdomain, $id)
	{
		$color = Color::find($id);
		if (!Session::has('lang') || Session::get('lang') == 'es') {
			return Response::json(array('data' => $color->description_es));
		}else
		{
			return Response::json(array('data' => $color->description_eng));
		}
	}
	public function getFabric($subdomain, $id)
	{
		$material = Material::find($id);
		if (!Session::has('lang') || Session::get('lang') == 'es') {
			return Response::json(array('data' => $material->description_es));
		}else
		{
			return Response::json(array('data' => $material->description_eng));
		}
	}
}
