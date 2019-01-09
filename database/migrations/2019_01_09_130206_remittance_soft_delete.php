<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemittanceSoftDelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('remittance', function ($table) {
            $table->softDeletes();
        });
        Schema::table('remittance_line', function ($table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('remittance', function ($table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('remittance_line', function ($table) {
            $table->dropColumn('deleted_at');
        });
    }
}
