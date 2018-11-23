<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRemittanceTableRenameBankVoucherId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('remittance', function (Blueprint $table) {
            $table->dropForeign('fk_remittance_bank_voucher');
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
        Schema::table('remittance', function (Blueprint $table) {
	    $table->renameColumn('remittance_lot_id', 'bank_voucher_id');
	    /* Add foreign key to bank_voucher table. */
            $table->foreign('bank_voucher_id', 'fk_remittance_bank_voucher')->references('bank_voucher_id')->on('bank_voucher');
        });
    }
}
