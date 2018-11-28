<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRemittanceTableDeliverdByNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('remittance', function (Blueprint $table) {
            $table->string('delivered_by', 100)->nullable()->change();
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
            $table->string('delivered_by', 100)->nullable(false)->change();
        });
    }
}
