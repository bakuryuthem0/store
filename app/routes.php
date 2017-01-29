<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::group(array('domain' => '{subdomain}.localhost'), function() {

	Route::get('tienda/cambiar-lenguaje/{lang}',function($domain,$lang)
	{
		switch ($lang) {
			case 'spanish':
				Session::set('lang', 'es');
				break;
			case 'english':
				Session::set('lang', 'eng');
				break;
			default:
				Session::remove('lang');
				Session::set('lang', Config::get('app.locale'));
				break;
		}
		return Redirect::back();
	});

	Route::get('/','HomeController@getIndex');
	Route::get('inicio/login','UserController@getLogin');
	Route::get('inicio/registrese','UserController@getRegister');
	Route::post('inicio/registrese/enviar','UserController@postRegister');
	Route::get('tienda/contectenos','ContactController@getContact');

	Route::get('tienda/ver-producto/{id}','HomeController@getItemSelf');
	Route::get('tienda/checkout','HomeController@getCheckout');
	Route::get('tienda/buscar-talla/{id}','HomeController@getSize');
	Route::get('tienda/buscar-color/{id}','HomeController@getColor');
	Route::get('tienda/buscar-tela/{id}','HomeController@getFabric');
	//busqueda
	Route::get('tienda/productos/categoias','ShopController@getAllCategories');
	Route::get('tienda/productos/{type}/{id}','ShopController@getItemsByCat');
	Route::get('tienda/productos/busqueda','ShopController@getSearch');

	Route::get('cambiar-vista/{grid_type}','ShopController@changeGrid');
	Route::group(array('before' => 'no_auth'),function()
	{
		Route::get('administrador/login','AdminController@getLogin');
		
		Route::group(array('before' =>'csrf'),function()
		{
			Route::post('tienda/login/enviar','UserController@postLogin');
			Route::post('administrador/login/enviar','AdminController@postLogin');
		});
	});
	Route::group(array('before' => 'auth'),function()
	{
		Route::post('tienda/checkout/procesar','ShopController@postProceed');
		//COMPRAS
		Route::get('tienda/usuario/mis-compras','ShopController@getUserFact');
		Route::get('tienda/usuario/ver-compra/{id}','ShopController@getUserFactDetails');
		Route::post('tienda/usuario/factura/procesar/{id}','ShopController@postUserFact');
		//perfil
		Route::get('tienda/usuario/perfil','UserController@getProfile');
		Route::post('tienda/usuario/cambiar-avatar','UserController@postNewAvatar');
		Route::post('tienda/usuario/modificar-perfil/enviar','UserController@postProfile');

		Route::post('administrador/usuario/perfil/cambiar-contrasena/enviar','UserController@postAdminUserNewPass');
		//shipping
		Route::post('tienda/usuario/envios/enviar','UserController@newShipping');
		Route::post('tienda/usuario/eliminar-direccion','UserController@postElimShipping');

		//lista de deseos
		Route::get('tienda/agregar-favorito','ShopController@getFav');
		Route::get('tienda/mi-lista-de-deseos','ShopController@getMyWishlist');

		//comentarios
		Route::get('tienda/comentario/enviar','CommentController@newComment');
		//logout
		Route::get('tienda/logout','UserController@getLogout');
	});


	Route::group(array('before' =>'auth_admin'),function()
	{
		Route::get('administrador','AdminController@getIndex');

		//perfil
		Route::get('administrador/usuario/perfil','UserController@getAdminUserProfile');
		Route::post('administrador/usuario/perfil/enviar','UserController@postAdminUserProfile');
		//Editar tienda
		Route::get('administrador/tienda/agregar-logo','AdminController@getNewLogo');
		Route::post('administrador/tienda/agregar-logo/enviar','AdminController@postNewLogo');
		Route::get('administrador/tienda/editar-colores','AdminController@getEditColors');
		Route::post('administrador/tienda/editar-colores/enviar','AdminController@postEditColors');
		Route::get('administrador/tienda/nuevo-slide','ShopController@getBanner');
		Route::post('administrador/tienda/banner/enviar','ShopController@postBanner');
		//usuarios
		Route::get('administrador/usuario/nuevo','AdminController@getNewUser');
		Route::post('administrador/usuario/nuevo/enviar','AdminController@postNewUser');
		Route::get('administrador/ver-usuarios','AdminController@getUsers');
		Route::post('administrador/cambiar-password','AdminController@postChangePass');
		Route::post('administrador/eliminar-usuario','AdminController@postUserElim');
		//categorias
		Route::get('administrador/categorias/nueva','AdminController@getNewCat');
		Route::post('administrador/categoria/nueva/enviar','AdminController@postNewCat');
		Route::get('administrador/categorias/ver-categorias','AdminController@getCat');
		Route::get('administrador/categorias/ver-categorias/{id}','AdminController@getCatById');
		Route::post('administrador/categorias/ver-categorias/{id}/enviar','AdminController@postCatById');
		Route::post('administrador/categorias/eliminar','AdminController@postElimCat');
		Route::get('activar-categorias-menu','AdminController@activateCat');
		Route::get('activar-sub-categorias-menu','AdminController@activateSubCat');

		//subcat
		Route::get('administrador/sub-categorias/nueva','AdminController@getNewSubCat');
		Route::post('administrador/sub-categoria/nueva/enviar','AdminController@postNewSubCat');
		Route::get('administrador/categorias/ver-sub-categorias','AdminController@getSubCat');
		Route::get('administrador/categorias/ver-sub-categorias/{id}','AdminController@getSubCatById');
		Route::post('administrador/sub-categorias/ver-sub-categorias/{id}/enviar','AdminController@postSubCatById');
		Route::post('administrador/sub-categorias/eliminar','AdminController@postElimSubCat');
		//Productos
		Route::get('administrador/nuevo-producto','ShopController@getNewItem');
		Route::post('administrador/producto/nuevo/enviar','ShopController@postNewItem');
		Route::get('administrador/ver-productos','ShopController@getProducts');
		Route::get('administrador/productos/modificar/{id}','ShopController@getItem');
		Route::post('administrador/productos/modificar/enviar/{id}','ShopController@postMdfItem');
		Route::post('administrador/ver-productos/eliminar','ShopController@postElimItem');

		Route::post('administrador/productos/modificar/eliminar-talla','ShopController@postElimSize');
		Route::post('administrador/productos/modificar/eliminar-color','ShopController@postElimColor');
		Route::post('administrador/productos/modificar/eliminar-material','ShopController@postElimFabric');

		Route::get('administrador/producto/cargar-detalles','ShopController@getItemInfo');
		Route::get('administrador/buscar-sub-categorias','ShopController@getSubCat');

		//marcas
		Route::get('administrador/nueva-marca','BrandController@getNewBrand');
		Route::post('administrador/nueva-marca/enviar','BrandController@postNewBrand');
		Route::get('administrador/ver-marcas','BrandController@getShowBrand');
		Route::get('administrador/ver-marcas/modificar/{id}','BrandController@getMdfBrand');
		Route::post('administrador/modificar-marca/enviar','BrandController@postMdfBrand');
		Route::post('administrador/eliminar-marca','BrandController@postElimBrand');
		//pagos
		Route::get('administrador/ver-pagos','AdminController@getPayments');
		Route::post('administrador/rechazar-pago','AdminController@postRejectPayment');
		Route::post('administrador/aprobar-pago','AdminController@postAprovePayment');
		//ofertas
		Route::get('administrador/nueva-oferta','ShopController@getNewOffert');
		Route::post('administrador/nueva-oferta/enviar','ShopController@postNewOffert');
		Route::get('administrador/ver-ofertas','ShopController@getOfferts');
		Route::post('administrador/ver-ofertas/eliminar-oferta','ShopController@postElimOffert');
		Route::post('administrador/ver-ofertas/remover-item','ShopController@postRemoveItem');


		Route::get('administrador/logout','AdminController@getLogout');
	});
});
