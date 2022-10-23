<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as faker;
use App\Models\User;

class UserTableSeeder extends Seeder
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
            User::create([
                'name' => $faker->name($gender = 'others'|'male'|'female'),
                'email'=> $faker->unique()->freeEmail(),
                'password'=> bcrypt('user123')
                ]);
    	}
    }
}
