<?php

use Illuminate\Database\Seeder;

class OblateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	/* Add records to oblate table. */

	/* Todo: Refer existing vlaues in database so
	         this seed can be run multiple times
		 without any issues.
        */
	$family_id = 1;
	$person_id = 2;
	$ritwik_id = 1;

	for ($i=0; $i<9; $i++) {
            DB::table('oblate')->insert([
                'family_id' => $family_id,
                'person_id' => $person_id,
	        'ritwik_id' => $ritwik_id,
	        'creator_id' => 1,
	        'created_time' => \Carbon\Carbon::now(),
	        'updated_time' => \Carbon\Carbon::now(),
	        'comment' => str_random(5),
            ]);
	    $person_id++;
	}
    }
}
