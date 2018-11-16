<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class PersonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
	/* Add records to person table. */
	for ($i=0;$i<10; $i++) {
            DB::table('person')->insert([
                'first_name' => $faker->firstName,
	        'middle_name' => str_random(5),
                'last_name' => $faker->lastName,
	        'creator_id' => 1,
	        'created_time' => \Carbon\Carbon::now(),
	        'updated_time' => \Carbon\Carbon::now(),
	        'comment' => str_random(5),
            ]);
	}
    }
}
