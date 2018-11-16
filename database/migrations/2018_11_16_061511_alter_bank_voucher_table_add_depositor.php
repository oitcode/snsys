<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterBankVoucherTableAddDepositor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bank_voucher', function (Blueprint $table) {
            /* Add deposited_by column. */
	    $table->string('deposited_by', 100)->after('deposit_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bank_voucher', function (Blueprint $table) {
            /* Remove deposited_by column. */
	    $table->dropColumn('deposited_by');
        });
    }
}
