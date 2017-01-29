<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	protected $faker;
	public function getFaker()
	{
		if (empty($this->faker))
		{
		  $this->faker = Faker\Factory::create();
		}
		return $this->faker;
	}
	public function run()
	{
		Eloquent::unguard();
		$this->call("ItemTableSeeder");
		//$this->call("AccountTableSeeder");
		//$this->call("CategoryTableSeeder");
		// $this->call('UserTableSeeder');
	}

}
