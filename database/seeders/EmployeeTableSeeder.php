<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as faker;
use App\Models\Employee;
use App\Models\User;
class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$users = User::all()->pluck('id')->toArray();
        $faker = Faker::create();
        foreach(range(1,20) as $index){
            Employee::create([
            	'user_id' => $faker->randomElement($users),
                'fname' => $faker->firstname($gender = 'others'|'male'|'female'),
                'lname' => $faker->lastname($gender = 'others'|'male'|'female'),
                'addressline' => $faker->address(),
                'town' => $faker->city(),
                'zipcode' => $faker->postcode(),
                // 'email'=> $faker->unique()->freeEmail(),
                // 'password'=> bcrypt('user123')
                // 'imagePath'=> $faker->imageUrl(640, 480, 'animals', true)
                ]);
    	}
    }
}
