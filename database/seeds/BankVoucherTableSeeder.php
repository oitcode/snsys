<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class BankVoucherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
	/* Add records to bank_voucher table. */
	/* Todo: See what is in database base
	         and insert acceptable values.
        */

	$voucher_number = 1000001;
	$deposit_date = '2018-11-10';
	$amount = 12345;

	for ($i=0; $i<10; $i++) {
            DB::table('bank_voucher')->insert([
                'voucher_number' => $voucher_number,
		'deposit_date' => $deposit_date,
                'deposited_by' => $faker->name,
		'amount' => $amount,
	        'comment' => str_random(10),
            ]);
	    $voucher_number++;
	}
    }
}
