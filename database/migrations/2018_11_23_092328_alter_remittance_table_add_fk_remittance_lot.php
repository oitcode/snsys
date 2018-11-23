<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRemittanceTableAddFkRemittanceLot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('remittance', function (Blueprint $table) {
	    /* Add foreign key to remittance_lot table. */
            $table->foreign('remittance_lot_id', 'fk_remittance_remittance_lot')->references('remittance_lot_id')->on('remittance_lot');
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
	    $table->dropForeign('fk_remittance_remittance_lot');
        });
    }
}
