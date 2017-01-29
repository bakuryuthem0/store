<?php

class UserController extends BaseController {
	public function upload_image($file,$ruta)
	{
		$extension = File::extension($file->getClientOriginalName());
		$time = time();
		$miImg = $time.'.'.$extension;
		while (file_exists($ruta.$miImg)) {
			$time = time();
			$miImg = $time.'.'.$extension;
		}
        $file->move($ruta,$miImg);

        $img 	= Intervention::make($ruta.'/'.$miImg);
        
        $img->interlace()
        ->save($ruta.'/'.$miImg);
        return $miImg;
	}
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
	public function getLogin($subdomain)
	{
		$store = $this->getInfo($subdomain);

		$title = Lang::get('lang.login_title')." | nombredelapagina";
		return View::make($store->template.'.auth.login')
		->with('title',$title)
		->with('store',$store);
	}
	public function postLogin()
	{
		$data = array(
			'email'		=> Input::get('email'),
			'password'	=> Input::get('password'),

		);
		if (Auth::attempt($data)) {
			$log = new LastLogin;
			$log->user_id = Auth::user()->id;
			$log->login = date('Y-m-d H:i:s',time());
			$log->save();
			Session::flash('success', 'Se ha iniciado sesión satisfactoriamente. Espere mientra lo redireccionamos.');
			return Redirect::intended();
		}else
		{
			Session::flash('danger','Error al tratar de iniciar sesión, Usuario o contraseña incorrectos.');
			return Redirect::back();
		}
	}
	public function getRegister($subdomain)
	{
		$store = $this->getInfo($subdomain);

		$title = Lang::get('lang.register_title')." | nombredelapagina";
		return View::make($store->template.'.auth.register')
		->with('title',$title)
		->with('store',$store);
	}
	public function postRegister()
	{
		$data  = Input::all();
		$rules = array(
			'name' 					=> 'required|min:3|max:16',
			'lastname' 				=> 'required|min:3|max:16',
			'email' 				=> 'required|email|min:5',
			'password' 				=> 'required|min:6|max:16|confirmed',
			'password_confirmation' => 'required|min:6|max:16',
			'address' 				=> 'required|min:4',
		);
		$msg  = array();
		$attr = array(
			'name' 					=> Lang::get('lang.register_firstname'),
			'lastname' 				=> Lang::get('lang.register_lastname'),
			'password' 				=> Lang::get('lang.register_password'),
			'password_confirmation' => Lang::get('lang.register_confirm_pass'),
			'address' 				=> Lang::get('lang.register_address'),
		); 
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$user = new User;
		$user->name 	= $data['name'];
		$user->lastname = $data['lastname'];
		$user->email 	= $data['email'];
		$user->password = Hash::make($data['password']);
		$user->address  = $data['address'];
		if ($user->save()) {
			Session::flash('success', Lang::get('lang.register_success'));
			return Redirect::to('inicio/login');
		}else
		{
			Session::flash('danger', Lang::get('lang.register_danger'));
			return Redirect::back();
		}

	}
	public function getAdminUserProfile()
	{
		$title = "Perfil de usuario | nombredelapagina";
		return View::make('admin.user.profile')
		->with('title',$title);
	}
	public function postAdminUserProfile()
	{
		Session::flash('act','perfil');
		$data  = Input::all();
		$rules = array(
			'name'  	=> 'required',
			'lastname'  => 'required',
		);
		$msg = array();
		$cus = array(
			'name' 		=> 'nombre',
			'lastname'	=> 'apellido'
		);
		$validator = Validator::make($data, $rules, $msg, $cus);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator);
		}
		$name  		= Input::get('name');
		$lastname 	= Input::get('lastname');
		$user  		= User::find(Auth::id());
		if ($name != Auth::user()->name) {
		 	$user->name = $name;
	 	} 
	 	if ($lastname != Auth::user()->lastname) {
		 	$user->lastname = $lastname;
	 	}
	 	if (Input::hasFile('avatar')) {
	 		$img = Input::file('avatar');
	 		$user->avatar = $this->upload_image($img,'images/avatars');
	 	}
	 	if ($user->save()) {
	 		Session::flash('success','Se actualizaron los datos satisfactoriamente.');
	 	 	return Redirect::back();
	 	 } 
	}
	public function postAdminUserNewPass()
	{
		Session::flash('act','pass');
		$data = Input::all();
		Validator::extend('checkCurrentPass', function($attribute, $value, $parameters)
		{
		    if( ! Hash::check( $value , $parameters[0] ) )
		    {
		        return false;
		    }
		    return true;
		});
		$rules = array(
			'password_old' 			=> 'required|checkCurrentPass:'.Auth::user()->password,
			'password'	   			=> 'required|min:6|max:16|confirmed',
			'password_confirmation' => 'required',
		);
		$msg = array();
		$cust = array(
			'password_old' 			=> 'contraseña actual',
			'password'	   			=> 'nueva contraseña',
			'password_confirmation' => 'confirmación de la contraseña'
		);
		$validator = Validator::make($data, $rules, $msg, $cust);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator);
		}

		$user = User::find(Auth::id());
		$user->password = Hash::make($data['password']);
		if ($user->save()) {
			Session::flash('success','Se ha cambiado su contraseña satisfactoriamente.');
			return Redirect::back();
		}
	}
	public function getProfile($subdomain)
	{
		$shop 	 = new ShopController; 
		$store 	 = $shop->getInfo($subdomain);

		$title 	 = Lang::get('lang.profile')." | nombredelapagina";

		$default = ShippingAddress::where('user_id','=',Auth::id())->where('is_default','=',1)->first();
		if (empty($default) || is_null($default)) {
			$dir 	 = ShippingAddress::where('user_id','=',Auth::id())->get();
		}else
		{
			$dir	 = ShippingAddress::where('user_id','=',Auth::id())->where('is_default','=',0)->get();
		}
		return View::make($store->template.'.user.profile')
		->with('title',$title)
		->with('store',$store)
		->with('dir',$dir)
		->with('default',$default);
	}
	public function postNewAvatar()
	{
		$data = Input::file('file');
		if (Auth::user()->avatar != "avatar5.png") {
			File::delete('images/avatars/'.Auth::user()->avatar);
		}
		$user = User::find(Auth::id());
		$user->avatar = $this->upload_image($data,'images/avatars');
		$user->save();
		return Response::json(array('type' => 'success','msg' => Lang::get('lang.avatar_success'),'data' => $user->avatar));
	}
	public function postProfile()
	{
		Session::flash('act','perfil');
		$data  = Input::all();
		$rules = array(
			'name'  	=> 'required',
			'lastname'  => 'required',
			'address'	=> 'required',
		);
		$msg = array();
		$cus = array(
			'name' 		=> Lang::get('lang.register_firstname'),
			'lastname'	=> Lang::get('lang.register_lastname'),
			'address'	=> Lang::get('lang.register_address')
		);
		$validator = Validator::make($data, $rules, $msg, $cus);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator);
		}
		$name  		= Input::get('name');
		$lastname 	= Input::get('lastname');
		$address 	= Input::get('address');
		$user  		= User::find(Auth::id());
		if ($name != Auth::user()->name) {
		 	$user->name = $name;
	 	} 
	 	if ($lastname != Auth::user()->lastname) {
		 	$user->lastname = $lastname;
	 	}
	 	if ($address != Auth::user()->address) {
		 	$user->address = $address;
	 	}
	 	if ($user->save()) {
	 		Session::flash('success','Se actualizaron los datos satisfactoriamente.');
	 	 	return Redirect::back();
	 	 } 
	}
	public function newShipping()
	{
		$data = Input::all();
		if (isset($data['address'])) {
			foreach($data['address'] as $key => $d)
			{
				$aux = ShippingAddress::where('user_id','=',Auth::id())->where('address','=',$d)->where('id','=',$data['default'])->first();
				if (empty($aux) || is_null($aux)) {
					$ship = new ShippingAddress;
					if($key == $data['default'] && $data['default'] != "user_address")
					{
						$ship->is_default = 1;
					}
					$ship->address = $d;
					$ship->user_id = Auth::id();
					$ship->save();
				}
			}
		}else
		{
			if($data['default'] == "user_address")
			{
				$aux = ShippingAddress::where('user_id','=',Auth::id())->where('is_default','=',1)->first();
				$aux->is_default = 0;
				$aux->save();
			}else
			{
				$aux = ShippingAddress::find($data['default']);
				$aux->is_default = 1;
				$aux->save();
			}
		}
		Session::flash('act','shipping');
		Session::flash('success','Se actualizaron los datos satisfactoriamente.');
		return Redirect::back();
	}
	public function postElimShipping()
	{
		$id = Input::get('id');
		ShippingAddress::find($id)->delete();
		return Response::json(array(
			'type' 	=> 'success',
			'msg'	=> Lang::get('lang.address_deleted')
		));
	}
	public function getLogout()
	{
		$log =  LastLogin::where('user_id','=',Auth::id())->orderBy('id','DESC')->first();
		$log->logout = date('Y-m-d H:i:s',time());
		$log->save();
		Auth::logout();
		return Redirect::to('/');
	}
}
