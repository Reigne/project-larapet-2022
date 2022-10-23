<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as faker;
use App\Models\Grooming;

class GroomingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1,10) as $index){
            Grooming::create([
            	'description' => $faker->unique()->word(),
            	'price' => $faker->numerify(),
                'imagePath'=> $faker->imageUrl(640, 480, 'animals', true)
                ]);
    	}
    }
}
