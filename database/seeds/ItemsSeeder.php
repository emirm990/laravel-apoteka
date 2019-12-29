<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Storage;

class ItemsSeeder extends Seeder
{
   
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path('app\public\images');
        $faker = Faker::create();
        for($i=1;$i<=100;$i++){
            DB::table('items')->insert([
                'name' => $faker->lastName,
                'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'image' => "/storage/images/" . $faker->image($path, 800, 600, 'animals', false),
                'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 25) ,
                'stock' => $faker->numberBetween($min = 10, $max = 2500),
                'created_at' => $faker->dateTimeThisYear($max = 'now', $timezone = null),
                'updated_at' => $faker->dateTimeThisYear($max = 'now', $timezone = null)
            ]);
        }
        
    }
}
