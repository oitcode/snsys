<?php

use Illuminate\Database\Seeder;

class RemittanceLineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	/* Add records to remittance_line table. */
	/* Todo: See what is in database base
	         and insert acceptable values.
        */

	$remittance_id = 2;

	for ($i=0; $i<10; $i++) {
	    for ($j=3; $j<10; $j++) {
                DB::table('remittance_line')->insert([
                    'remittance_id' => $remittance_id,
	            'oblate_id' => $j,

		    'swastyayani' => 5,
		    'istavrity' => 50,
		    'acharyavrity' => 15,
		    'dakshina' => 20,
		    'sangathani' => 0,
		    'ananda_bazar' => 0,
		    'pranami' => 10,
		    'swastyayani_awasista' => 13,
		    'ritwiki' => 14,
		    'utsav' => 3.5,
		    'diksha_pranami' => 0,
		    'acharya_pranami' => 0,
		    'parivrity' => 4.5,
		    'misc' => 75,

	            'creator_id' => 1,
	            'created_time' => \Carbon\Carbon::now(),
	            'updated_time' => \Carbon\Carbon::now(),
	            'comment' => str_random(5),
                ]);
	    }
	    $remittance_id++;
	}
    }
}
