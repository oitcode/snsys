<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRemittanceLotTableAddColumnLotCode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('remittance_lot', function (Blueprint $table) {
            $table->integer('lot_code')
	        ->unsigned()
		->nullable()
		->unique()
		->after('remittance_lot_id');
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
	    $table->dropColumn('lot_code');
        });
    }
}
