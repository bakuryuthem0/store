<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('items',function($table){
			$table->increments('id');
			$table->integer('cat_id');
			$table->integer('sub_cat_id');
			$table->integer('brand_id');
			$table->string('title_es',45);
			$table->string('title_eng',45);
			$table->float('price');
			$table->integer('stock');
			$table->text('description_es');
			$table->text('description_eng');
			$table->date('created_at');
			$table->date('updated_at');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
