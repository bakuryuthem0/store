<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaggingTaggedTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('tagging_tagged',function($table){
			$table->increments('id');
			$table->string('taggable_id',36);
			$table->string('taggable_type',255);
			$table->string('tag_name',255);
			$table->string('tag_slug',255);
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
