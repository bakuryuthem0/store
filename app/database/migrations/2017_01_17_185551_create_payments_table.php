<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('payments',function($table){
			$table->increments('id');
			$table->integer('factura_id');
			$table->string('reference_number',100);
			$table->string('transaction_method',45);
			$table->string('shop_bank',100);
			$table->string('user_bank',100);
			$table->date('transaction_date');
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
