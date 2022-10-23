<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as faker;

use App\Models\Customer;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1,20) as $index){
            $gender = $faker->randomElement(['Male', 'Female']);
            Customer::create([
                'title' => $faker->title($gender),
                'lname' => $faker->lastName(),
                'fname' => $faker->firstName($gender),
                'addressline' => $faker->address(),
                'town' => $faker->city(),
                'zipcode' => $faker->postcode(),
                'phone'=> $faker->phoneNumber(),
                'email'=> $faker->unique()->freeEmail(),
                // 'imagePath'=> $faker->image('public/storage/images',640,480, null, false)
                ]);
    }
    }
}
