<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRemittanceLotVoucherNumberNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('remittance_lot', function (Blueprint $table) {
            $table->string('voucher_number', 200)->unique()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('remittance_lot', function (Blueprint $table) {
            $table->string('voucher_number', 200)->unique()->nullable(false)->change();
        });
    }
}
