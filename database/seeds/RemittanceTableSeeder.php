<?php

use Illuminate\Database\Seeder;

class RemittanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	/* Add records to remittance table. */
	/* Todo: See what is in database base
	         and insert acceptable values.
        */

	$family_id = 1;
	$submitter_id = 1;
	$submitted_date = [
	    '2018-01-01',
	    '2018-02-01',
	    '2018-03-01',
	    '2018-04-01',
	    '2018-05-01',
	    '2018-06-01',
	    '2018-07-01',
	    '2018-08-01',
	    '2018-09-01',
	    '2018-10-01',
	];
	$delivered_by = 'Lekhnath Poudel';
	$bank_voucher_id = 1;
	$creator_id = 1;

	for ($i=0; $i<10; $i++) {
            DB::table('remittance')->insert([
                'family_id' => $family_id,
		'submitter_id' => $submitter_id,
                'submitted_date' => $submitted_date[$i],
		'delivered_by' => $delivered_by,
	        'bank_voucher_id' => $bank_voucher_id,
	        'creator_id' => $creator_id,
	        'created_time' => \Carbon\Carbon::now(),
	        'updated_time' => \Carbon\Carbon::now(),
	        'comment' => str_random(5),
            ]);
	}
    }
}
