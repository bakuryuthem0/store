<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/
Route::filter('auth', function()
{
	if (!Auth::check())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::to('inicio/login');
		}
	}
});
Route::filter('auth_admin',function(){
	if (Auth::check() && Auth::user()->role_id != 3) {
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::to('/');
		}	
	}elseif(!Auth::check())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::to('administrador/login');
		}
	}
});
Route::filter('no_auth', function()
{
	if (Request::ajax()) {
		if (Auth::check()) 
		{
			return Response::json(array(
				'type' => 'danger',
				'msg'  => 'Error 403, Acceso restringido.',
			));
		}		
	}else
	{
		if (Auth::check()) 
		{
			return Redirect::to('administrador/');
		}
		
	}
	
});
Route::filter('role_check',function()
{
	if (Request::ajax()) {
		if (Auth::user()->role_id != 3 && Auth::user()->role_id != 2) 
		{
			return Response::json(array(
				'type' => 'danger',
				'msg'  => 'Error 403, Acceso restringido.',
			));
		}		
	}else
	{
		if (Auth::user()->role_id != 3 && Auth::user()->role_id != 2) {
			return Redirect::to('/');
		}
		
	}
});
Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Request::ajax()) {
		if (Session::token() !== Request::header('csrftoken')) {
			return Response::json(array(
				'type' => 'danger','msg' => Lang::get('lang.csrf_error')
			));			
		}		
	}elseif (Session::token() != Input::get('_token'))
	{
		Session::flash('danger',Lang::get('lang.csrf_error'));
		return Redirect::back();
	}
});