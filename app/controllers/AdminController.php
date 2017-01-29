<?php

class AdminController extends BaseController {

	public function getInfo($subdomain)
	{
		return App::make('stores', $subdomain); 
	}

	public function getLogin()
	{
		$title = "Administración | nombredelapagina";
		return View::make('admin.auth.login')
		->with('title',$title);
	}
	public function postLogin()
	{
		$data = Input::all();
		if (Auth::attempt($data)) {
			$log = new LastLogin;
			$log->user_id = Auth::user()->id;
			$log->login = date('Y-m-d H:i:s',time());
			$log->save();
			return Response::json(array('type' => 'success','msg' => 'Se ha iniciado sesión satisfactoriamente. Espere mientra lo redireccionamos.'));
		}else
		{
			return Response::json(array('type' => 'danger','msg' => 'Error al tratar de iniciar sesión, usuario o contraseña incorrectos.'));
		}
	}
	public function getIndex()
	{
		$title = "Inicio Administración | nombredelapagina";
		return View::make('admin.home.index')
		->with('title',$title);
	}
	public function getNewUser()
	{
		$title = "Crear nuevo usuario | nombredelapagina";
		return View::make('admin.user.new')
		->with('title',$title);
	}
	public function postNewUser()
	{
		$data  = Input::all();
		$rules = array(
			'email'	   => 'required|email|unique:users,email',
			'password' => 'required|min:4|max:16|confirmed',
			'password_confirmation' => 'required',
		);
		$msg = array();
		$attr = array(
			'password' => 'contraseña',
			'password_confirmation' => 'confirmación de la contraseña',
		);
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$user = new User;
		$user->email    = $data['email'];
		$user->password = Hash::make($data['password']);
		if ($user->save()) {
			Session::flash('success','Se ha creado el usuario satisfactoriamente.');
			return Redirect::back();
		}
 	}
 	public function getUsers()
 	{
 		$title = "Ver Usuarios | nombredelapagina";
 		$users = User::leftJoin('roles','roles.id','=','users.role_id')
 		->where('users.id','!=',Auth::id())
 		->orderBy('users.id','DESC')
 		->get(
 			array(
 				'users.id',
 				'users.email',
 				'roles.description'
 			));
 		return View::make('admin.user.show')
 		->with('title',$title)
 		->with('users',$users);
 	}
 	public function postChangePass()
 	{
 		$id = Input::get('user_id');
 		$data = Input::all();
 		$rules = array(
 			'password' => 'required|min:4|max:16|confirmed',
			'password_confirmation' => 'required',
 		);
 		$validator = Validator::make($data, $rules);
 		if ($validator->fails()) {
 			return Response::json(array(
 				'type' => 'danger',
 				'data' => $validator->getMessageBag()->toArray()
 			));
 		}
 		$user = User::find($id);
 		$user->password = Hash::make($data['password']);
 		$user->save();
 		return Response::json(array(
 			'type' => 'success',
 			'msg'  => 'Se ha cambiado la contraseña satisfactoriamente.'
 		));
 	}
 	public function postUserElim()
 	{
 		$id = Input::get('user_id');
 		$user = User::find($id);
 		if (count($user) < 1) {
 			return Response::json(array(
 				'type' => 'danger',
 				'msg'  => 'Error, el usuario ya fue borrado.',
 			));
 		}
 		if ($user->avatar != "avatar5.png") {
 			File::delete('images/avatars/'.$user->avatar);
 		}
 		$user->delete();
 		return Response::json(array(
 			'type' => 'success',
 			'msg'  => 'El usuario se ha eliminado satisfactoriamente.'
 		));
 	}
 	public function getNewCat()
	{
		$title = 'Nueva categoría | nombredelapagina';
		return View::make('admin.category.new')
		->with('title',$title);
	}
	public function postNewCat()
	{
		if (Input::has('name')) {
			$name = Input::get('name');
			$name_eng = Input::get('name_eng');
			$cat = new Categoria;
			$cat->description_es  = $name;
			$cat->description_eng = $name_eng;
			$cat->save();
			Session::flash('success','Se ha creado la categoría satisfactoriamente.');
			return Redirect::back();
		}else
		{
			Session::flash('danger','Debe introducir un nombre');
			return Redirect::back();
		}
	}
	public function getCat()
	{
		$title = "Ver categorías | nombredelapagina";
		$cat = Categoria::orderBy('id','DESC')->get();
		return View::make('admin.category.show')
		->with('title',$title)
		->with('cat',$cat);
	}
	public function getCatById($subdomain,$id)
	{
		$cat = Categoria::find($id);
		$title = "Modificar categoría: ".$cat->description_es.' | nombredelapagina';
		return View::make('admin.category.self')
		->with('cat',$cat)
		->with('title',$title);
	}
	public function postCatById($subdomain, $id)
	{
		$cat   = Categoria::find($id);
		if (Input::has('name')) {
			$name = Input::get('name');
			$name_eng = Input::get('name_eng');
			$cat = Categoria::find($id);
			$cat->description_es = $name;
			$cat->description_eng = $name_eng;
			$cat->save();
			Session::flash('success','Se ha creado la categoría satisfactoriamente.');
			return Redirect::back();
		}else
		{
			Session::flash('danger','Debe introducir un nombre');
			return Redirect::back();
		}
	}
	public function postElimCat()
	{
		$id  = Input::get('cat_id');
		$cat = Categoria::find($id)->delete();
		return Response::json(array('type' => 'success','msg' => 'Se ha eliminado la categoría satisfactoriamente.'));
		
	}
	public function activateCat()
	{
		$id = Input::get('id');
		$cat = Categoria::find($id);
		if ($cat->menu_active == 0) {
			$aux = Categoria::where('menu_active','=',1)->count();
			if ($aux >= 3) {
				return Response::json(array(
					'type' => 'danger',
					'msg'  => 'maximo 3 categorías en el menu.'
				));
			}
			$cat->menu_active = 1;
		}else
		{
			$cat->menu_active = 0;
		}
		$cat->save();
		return Response::json(array(
			'type' 		=> 'success',
			'status'	=> $cat->menu_active,
		));
	}
	public function activateSubCat()
	{
		$id = Input::get('id');
		$cat = SubCat::find($id);
		if ($cat->menu_active == 0) {
			$aux = SubCat::where('menu_active','=',1)->count();
			if ($aux >= 8) {
				return Response::json(array(
					'type' => 'danger',
					'msg'  => 'maximo 8 sub-categorías en el menu.'
				));
			}
			$cat->menu_active = 1;
		}else
		{
			$cat->menu_active = 0;
		}
		$cat->save();
		return Response::json(array(
			'type' 		=> 'success',
			'status'	=> $cat->menu_active,
		));
	}
	public function getNewSubCat()
	{
		$title = 'Nueva categoría | nombredelapagina';
		$cat = Categoria::get();
		return View::make('admin.category.sub.new')
		->with('title',$title)
		->with('cat',$cat);
	}
	public function postNewSubCat()
	{
		if (Input::has('name')) {
			$name = Input::get('name');
			$name_eng = Input::get('name_eng');
			$cat = Input::get('cat_id');
			$subcat = new SubCat;
			$subcat->cat_id = $cat;
			$subcat->description_es  = $name;
			$subcat->description_eng = $name_eng;
			$subcat->save();
			Session::flash('success','Se ha creado la categoría satisfactoriamente.');
			return Redirect::back();
		}else
		{
			Session::flash('danger','Debe introducir un nombre');
			return Redirect::back();
		}
	}
	public function getSubCat()
	{
		$title = "Ver categorías | nombredelapagina";
		$cat = SubCat::leftJoin('categorias','categorias.id','=','sub_categorias.cat_id')->orderBy('id','DESC')->get(array(
			'categorias.description_es as categoria',
			'sub_categorias.description_es',
			'sub_categorias.description_eng',
			'sub_categorias.id',
			'sub_categorias.menu_active',
		));
		return View::make('admin.category.sub.show')
		->with('title',$title)
		->with('cat',$cat);
	}
	public function getSubCatById($subdomain, $id)
	{
		$subcat = SubCat::find($id);
		$cat = Categoria::get();
		$title = "Modificar categoría: ".$subcat->description_es.' | nombredelapagina';
		return View::make('admin.category.sub.self')
		->with('cat',$cat)
		->with('title',$title)
		->with('subcat',$subcat);
	}
	public function postSubCatById($subdomain, $id)
	{
		$cat   = Categoria::find($id);
		if (Input::has('name')) {
			$name = Input::get('name');
			$name_eng = Input::get('name_eng');
			$cat = Input::get('cat_id');
			$subcat = SubCat::find($id);
			$subcat->cat_id = $cat;
			$subcat->description_es = $name;
			$subcat->description_eng = $name_eng;
			$subcat->save();
			Session::flash('success','Se ha creado la categoría satisfactoriamente.');
			return Redirect::back();
		}else
		{
			Session::flash('danger','Debe introducir un nombre');
			return Redirect::back();
		}
	}
	public function postElimSubCat()
	{
		$id  = Input::get('cat_id');
		$cat = SubCat::find($id)->delete();
		return Response::json(array('type' => 'success','msg' => 'Se ha eliminado la categoría satisfactoriamente.'));
	}
	public function getPayments($subdomain)
	{
		$title = "Ver pagos | nombredelapagina";

		$store = $this->getInfo($subdomain);

		$payments = Factura::with(array('payments' => function($query)
		{
			$query->with('banks');
			
		}))
		->with('users')
		->with(array('compras' => function($query){
			$query->with('items')->with('tallas')->with('colores')->with('materiales');
		}))
		->where('canceled','=',0)
		->where('was_paid','=',1)
		->get();
		return View::make('admin.payments.index')
		->with('title',$title)
		->with('payments',$payments)
		->with('total',$total = 0)
		->with('store',$store);
	}
	public function postRejectPayment($subdomain)
	{
		$id 	 = Input::get('id');
		$motivo  = Input::get('motivo');
		$payment = Payment::find($id);
		$fact 	 = Factura::find($payment->factura_id);
		$fact->was_paid = 0;
		$fact->save();
		$data = [
			'store_logo' 		=> $this->getInfo($subdomain)->store_logo,
			'factura_id'	=> $fact->id,
			'motivo'		=> $motivo,
			'title'			=> Lang::get('lang.reject_payment_email')
		];
		$user = User::find($fact->user_id);
		$to_Email = $user->email;
		$subject = Lang::get('lang.reject_payment_email').' | nombredelapagina';
		Mail::queue('emails.payment-reject', $data, function($message) use ($to_Email, $subject)
		{
			$message->to($to_Email)->from('nombredelapagina@freekinglancers.com')->subject($subject);
		});
		$payment->delete();
		return Response::json(array(
			'type' 	=> 'success',
			'msg'	=> 'Pago rechazado satisfactoriamente.',
		));
	}
	public function postAprovePayment($subdomain)
	{
		$id = Input::get('id');
		$payment = Payment::find($id);
		$fact 	 = Factura::find($payment->factura_id);

		$compras = Compra::where('factura_id','=',$fact->id)->with('items')->get();
		foreach ($compras as $c) {
			$c->items->stock = $c->items->stock - $c->qty;
			$c->items->save();
		}
		$fact->was_paid = 2;
		$fact->save();
		$data = [
			'store_logo' 	=> $this->getInfo($subdomain)->store_logo,
			'factura_id'	=> $fact->id,
			'title'			=> Lang::get('lang.aprove_payment_email')
		];
		$user = User::find($fact->user_id);
		$to_Email = $user->email;
		$subject = Lang::get('lang.aprove_payment_email').' | nombredelapagina';
		Mail::queue('emails.payment-aproved', $data, function($message) use ($to_Email, $subject)
		{
			$message->to($to_Email)->from('nombredelapagina@freekinglancers.com')->subject($subject);
		});
		return Response::json(array(
			'type'	=> 'success',
			'msg'	=> 'Se a aprobado el pago satisfactoriamente.'
		));
	}
	public function getLogout()
	{
		$log =  LastLogin::where('user_id','=',Auth::id())->orderBy('id','DESC')->first();
		$log->logout = date('Y-m-d H:i:s',time());
		$log->save();
		Auth::logout();
		Session::flash('success', 'Sesión cerrada satisfactoriamente.');
		return Redirect::to('administrador');
	}
	public function getNewLogo($subdomain)
	{
		$store = ShopType::getShopInfo();
		if ($store->store_plan < 2) {
			Session::flash('danger','Usted no tiene permisos para acceder a esta area.');
			return Redirect::back();
		}
		$title = "Agregar / Cambiar Logo | nombredelapagina";
		return View::make('admin.store.changeLogo')
		->with('title',$title)
		->with('store',$store);
	}
	public function postNewLogo($subdomain)
	{
		$data  = Input::all();
		$rules = array(
			'logo'	=> 'required|image|max: 3000',
		);
		$validator = Validator::make($data, $rules);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$file = Input::file('logo');
		$store = Stores::where('subdomain','=',$subdomain)->first();
		$store->store_logo = ImageController::upload_image($file,$file->getClientOriginalName(),'images/');
		$img = Intervention::make('images/'.$store->store_logo)->interlace()->save('images/'.$store->store_logo);
		$store->save();
		Session::flash('success','Se ha actualizado el logo satisfactoriamente.');
		return Redirect::back();

	}
	public function getEditColors($subdomain)
	{
		$store = ShopType::getShopInfo();
		if ($store->store_plan < 2) {
			Session::flash('danger','Usted no tiene permisos para acceder a esta area.');
			return Redirect::back();
		}
		$title = "Editar colores | nombredelapagina";
		return View::make('admin.store.changeColor')
		->with('title',$title)
		->with('store',$store);
	}
	public function postEditColors($subdomain)
	{
		Validator::extend('color', function($attribute, $value, $parameters)
		{
			if (strpos($value,'#')) {
				return false;
			}
		    return preg_match('/[a-f0-9]{6}/i', $value);
		});
		$data  = Input::all();
		$rules = array(
			'first_background'	=> 'required|color',
			'first_color'		=> 'required|color',
			'second_background'	=> 'required|color',
			'second_color'		=> 'required|color',
			'third_background'	=> 'required|color',
			'third_color'		=> 'required|color',

		);
		$msg = array(
			'color'	=> 'El campo :attribute debe ser un valor hexadecimal sin abreviar',
		);
		$attr = array(
			'first_background'	=> 'Color de fondo(primario)',
			'first_color'		=> 'Color de texto(primario)',
			'second_background'	=> 'Color de fondo(secundario)',
			'second_color'		=> 'Color de texto(secundario)',
			'third_background'	=> 'Color de fondo(terciario)',
			'third_color'		=> 'Color de texto(terciario',
		);
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$palet = array();
		$palet['first'] 	= array('background_color' => $data['first_background'], 'color'  => $data['first_color']);
		$palet['second'] 	= array('background_color' => $data['second_background'], 'color' => $data['second_color']);
		$palet['third'] 	= array('background_color' => $data['third_background'], 'color'  => $data['third_color']);
		$store = Stores::where('subdomain','=',$subdomain)->first();
		$store->color_palet = json_encode($palet);
		$store->save();

		Session::flash('success','Se ha actualizado la paleta de colores satisfactoriamente.');
		return Redirect::back();

	}
}