<?php
class ItemTableSeeder extends DatabaseSeeder
{
  public function run()
  {
    $faker = $this->getFaker();
    for ($i = 0; $i < 50; $i++)
    {
      $item = Item::create([
        "cat_id"      => $faker->numberBetween($min = 8, $max = 14),
        "sub_cat_id"  => $faker->numberBetween($min = 20, $max = 70),
        "title_es"    => $faker->sentence($nbWords = rand(1,10), $variableNbWords = true) ,
        "title_eng"   => $faker->sentence($nbWords = rand(1,10), $variableNbWords = true) ,
        "description_es"   => $faker->paragraphs($nb = rand(2,4), $asText = true),
        "description_eng"   => $faker->paragraphs($nb = rand(2,4), $asText = true),
        "price"             => $faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = NULL),
        "stock"             => $faker->numberBetween($min = 1, $max = 9999),
        "created_at"        => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
        "updated_at"        => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
      ]);

      for($j = 0; $j < 3; $j++)
      {
        Talla::create([
          'item_id'         => $item->id,
          'description_es'  => $faker->word,
          'description_eng' => $faker->word,
          "created_at"        => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
          "updated_at"        => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
        ]);
        Color::create([
          'item_id'         => $item->id,
          'description_es'  => $faker->safeColorName,
          'description_eng' => $faker->safeColorName,
          "created_at"        => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
          "updated_at"        => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
        ]);
        Material::create([
          'item_id'         => $item->id,
          'description_es'  => $faker->word,
          'description_eng' => $faker->word,
          "created_at"        => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
          "updated_at"        => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
        ]);
        ItemImage::create([
          'item_id'     => $item->id,
          'image'       => $faker->imageUrl($width = 384, $height = 480),
          "created_at"  => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
          "updated_at"  => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
        ]);
      }
    }
  }
}