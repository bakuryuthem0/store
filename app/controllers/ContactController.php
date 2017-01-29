<?php

class ContactController extends BaseController {

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

	public function getContact()
	{
		$store = ShopType::getShopInfo();
		$title = Lang::get('lang.contact_title')." | nombredelapagina";
		return View::make($store->template.'.contact.index')
		->with('title',$title)
		->with('store',$store);
	}
	public function postContact()
	{
		$data  = Input::all();
		$rules = array(
			'name' 		=> 'required|min:3|max:16',
			'subject'	=> 'required|min:3|max:64',
			'email'		=> 'required|email',
			'msg'		=> 'required|min:4|max:1000',
		); 
		$msg = array();
		$attr = array(
			'name' 		=> 'nombre',
			'subject'	=> 'asunto',
			'msg'  		=> 'mensaje',
		);
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$datos = array(
			'subject' 	=> $data['subject'],
			'from' 		=> $data['email'],
			'fecha' 	=> date('Y/m/d H:i:s'),
			'email' 	=> $data['email'],
			'msg'		=> $data['msg'],
			'name'  	=> $data['name']
			);

		Mail::send('emails.envia', $datos, function($message) use ($data)
		{
			$message->to('email@email.com')->from($data['email'])->subject($data['subject']);
		});

		Session::flash('success', Lang::get('lang.contact_success'));
		return Redirect::back();
	}

}
