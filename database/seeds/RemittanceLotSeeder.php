<?php

use Illuminate\Database\Seeder;

class RemittanceLotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('remittance_lot')->insert([
            'lot_code' => 1,
    	'voucher_number' => '1281',
            'deposit_date' => '2018-11-01',
    	'deposited_by' => 'Gyanu Chauhan',
            'amount' => 0,
            'creator_id' => 1,
            'created_time' => \Carbon\Carbon::now(),
            'updated_time' => \Carbon\Carbon::now(),
            'comment' => str_random(5),
        ]);
    }
}
