<?php
class AccountTableSeeder extends DatabaseSeeder
{
  public function run()
  {
    $faker = $this->getFaker();
    for ($i = 0; $i < 10; $i++)
    {
      $email    = $faker->email;
      $password = Hash::make("password");
      User::create([
        "email"    => $email,
        "password" => $password,
        "name"     => $faker->firstName($gender = null|'male'|'female'),
        "lastname" => $faker->lastName,
        "address" => $faker->address,
        "role_id" => $faker->randomNumber($nbDigits = null, $min = 1, $max = 3),
        "avatar"  => "1474325936.jpg",
        "created_at"  => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
        "updated_at"  => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),

      ]);
    }
  }
}