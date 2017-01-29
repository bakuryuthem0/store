<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('users',function($table){
			$table->increments('id');
			$table->string('email',60)->unique();
			$table->string('password',100);
			$table->string('name',16);
			$table->string('lastname',16);
			$table->text('address');
			$table->integer('role_id');
			$table->string('remember_token',100);
			$table->string('avatar',20);
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
