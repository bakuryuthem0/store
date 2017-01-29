<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffertsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('offerts',function($table){
			$table->increments('id');
			$table->string('title_es',100);
			$table->string('title_eng',100);
			$table->string('subtitle_es',100);
			$table->string('subtitle_eng',100);
			$table->integer('percent');
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
