<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRemittanceLotAddPhDeliverer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('remittance_lot', function (Blueprint $table) {
            $table->date('philanthrophy_deposit_date', 100)->nullable();
            $table->string('philanthrophy_deposited_by')->nullable();
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
            $table->dropColumn('philanthrophy_deposit_date');
            $table->dropColumn('philanthrophy_deposited_by');
        });
    }
}
