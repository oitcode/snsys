<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterWorkerTablePersonIdUnique extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('worker', function (Blueprint $table) {
	    /* Make `person_id' column unique. */
            $table->unique('person_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('worker', function (Blueprint $table) {
	    /* Remove `person_id' column unique index. */
	    $table->dropUnique('worker_person_id_unique');
        });
    }
}
