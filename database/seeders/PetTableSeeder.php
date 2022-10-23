<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as faker;
use App\Models\Pet;
use App\Models\Customer;
class PetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = Customer::all()->pluck('id')->toArray();
        $faker = Faker::create();
        foreach(range(1,15) as $index){
            $gender = $faker->randomElement(['Male', 'Female']);
            Pet::create([
            	'customer_id' => $faker->randomElement($customers),
            	'name' => $faker->firstName($gender),
                'species' => $faker->randomElement(['Dog']),
                'breed' => $faker->randomElement(['Labrador', 'Bulldog', 'Pitbull', 'German Shepherd']),
                'gender' => $gender,
                'age' => $faker->randomDigitNotNull(),
                'color' => $faker->safeColorName()
                // 'imagePath'=> $faker->imageUrl(640, 480, 'animals', true)
                ]);

        // $faker = Faker::create();
        // foreach(range(1,25) as $index){
        //     $gender = $faker->randomElement(['Male', 'Female']);
        //     Pet::create([
        //         'customer_id' => $faker->numberBetween($min = 1, $max = 50),
        //         'name' => $faker->firstName($gender),
        //         'species' => $faker->randomElement(['Cat']),
        //         'breed' => $faker->randomElement(['Abyssinian', 'American Curl', 'American Shorthair', 'American Wirehair']),
        //         'gender' => $gender,
        //         'age' => $faker->randomDigitNotNull(),
        //         'color' => $faker->safeColorName()
        //         // 'imagePath'=> $faker->imageUrl(640, 480, 'animals', true)
        //         ]);
        // }
    	}
    }
}
