<?php
class CategoryTableSeeder extends DatabaseSeeder
{
  public function run()
  {
    $faker = $this->getFaker();
    for ($i = 0; $i < 5; $i++)
    {
      $cat = Categoria::create(array(
        "description_es"      => $faker->sentence($nbWords = rand(1,10), $variableNbWords = true) ,
        "description_eng"     => $faker->sentence($nbWords = rand(1,10), $variableNbWords = true) ,
        "created_at"          => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
        "updated_at"          => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
      ));
      for ($j=0; $j < 10; $j++) { 
        SubCat::create(array(
          "cat_id"              => $cat->id,
          "description_es"      => $faker->sentence($nbWords = rand(1,10), $variableNbWords = true) ,
          "description_eng"     => $faker->sentence($nbWords = rand(1,10), $variableNbWords = true) ,
          "created_at"          => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
          "updated_at"          => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
        ));
      }
    }
  }
}