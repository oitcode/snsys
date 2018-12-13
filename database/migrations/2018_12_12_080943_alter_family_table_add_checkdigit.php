<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterFamilyTableAddCheckdigit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('family', function (Blueprint $table) {
            // Add check digit column
            $table->string('fcode_check_digit', 1)
	        ->nullable()
	        ->after('family_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('family', function (Blueprint $table) {
            // Drop check digit column
            $table->dropColumn('fcode_check_digit');
        });
    }
}
