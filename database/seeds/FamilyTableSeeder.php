<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FamilyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	/* Add records to family table. */

	$family_code = 4700001234;

	for ($i=0; $i<10; $i++) {
            DB::table('family')->insert([
                'family_code' => $family_code,
                'address' => str_random(10) . " " .
	                     str_random(10) . " " .
	                     str_random(5) . " " .
	                     str_random(5) . " " .
	                     "Nepal",
                'creator_id' => 1,
	        'comment' => str_random(10),
            ]);
	    $family_code++;
	}
    }
}
