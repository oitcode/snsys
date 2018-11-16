<?php

use Illuminate\Database\Seeder;

class WorkerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	/* Add records to worker table. */
        DB::table('worker')->insert([
            'worker_code' => 'N00001',
	    'person_id' => 1,
            'type' => 'R',
	    'creator_id' => 1,
	    'created_time' => \Carbon\Carbon::now(),
	    'updated_time' => \Carbon\Carbon::now(),
	    'comment' => str_random(5),
        ]);
    }
}
