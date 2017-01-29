<?php

class BrandController extends BaseController {
	
	public function getNewBrand()
	{
		$store = ShopType::getShopInfo();
		$title = "Nueva Marca | ".$store->store_name;
		return View::make('admin.brands.new')
		->with('title',$title);
	}
	public function postNewBrand()
	{
		$data = Input::all();
		$rules = array(
			'name'	=> 'required',
			'logo'	=> 'required|image',
		);
		$msg = array();
		$attr= array(
			'name' => 'Nombre de la marca',
			'logo' => 'Logo de la marca',
		);
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$brand = new Brand;
		$brand->name = $data['name'];
		$file = Input::file('logo');
		$imgName = ImageController::upload_image($file,$file->getClientOriginalName(),'images/brands/');
		$img = Intervention::make('images/brands/'.$imgName);
		$img->interlace()
		->save();
		$brand->logo = $imgName;
		$brand->save();
		Session::flash('success','Marca agregada satisfactoriamente.');
		return Redirect::back();
	}
	public function getShowBrand()
	{
		$store  = ShopType::getShopInfo();
		$title  = "Ver Marcas |".$store->store_name;
		$brands = Brand::get();
		return View::make('admin.brands.show')
		->with('title',$title)
		->with('brands',$brands);
	}
	public function getMdfBrand($subdomain, $id)
	{
		$store  = ShopType::getShopInfo();
		$brand  = Brand::find($id);
		$title = "Modificar Marca | ".$store->store_name;
		return View::make('admin.brands.mdf')
		->with('title',$title)
		->with('brand',$brand);
	}
	public function postMdfBrand($subdomain)
	{
		$data = Input::all();
		$rules = array(
			'name'	=> 'required',
			'logo'	=> 'image',
		);
		$msg = array();
		$attr= array(
			'name' => 'Nombre de la marca',
			'logo' => 'Logo de la marca',
		);
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$brand = Brand::find($data['id']);
		$brand->name = $data['name'];
		if (Input::hasFile('logo')) {
			$file = Input::file('logo');
			$imgName = ImageController::upload_image($file,$file->getClientOriginalName(),'images/brands/');
			$img = Intervention::make('images/brands/'.$imgName);
			$img->interlace()
			->save();
			$brand->logo = $imgName;
		}
		$brand->save();
		Session::flash('success','Marca modificada satisfactoriamente.');
		return Redirect::back();
	}
	public function postElimBrand()
	{
		$id = Input::get('id');
		$brand = Brand::find($id);
		File::delete('images/brands/'.$brand->logo);
		$brand->delete();
		return Response::json(array(
			'type' => 'success',
			'msg'  => 'Se ha eliminado la marca satisfactoriamente.',
		));
	}
}