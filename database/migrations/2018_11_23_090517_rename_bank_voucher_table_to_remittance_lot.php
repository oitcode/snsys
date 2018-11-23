<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameBankVoucherTableToRemittanceLot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('bank_voucher', 'remittance_lot');

        Schema::table('remittance_lot', function (Blueprint $table) {
	    /* Rename primary key. */
            $table->renameColumn('bank_voucher_id', 'remittance_lot_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('remittance_lot', 'bank_voucher');
        Schema::table('bank_voucher', function (Blueprint $table) {
	    /* Rename primary key. */
            $table->renameColumn('remittance_lot_id', 'bank_voucher_id');
        });
    }
}
