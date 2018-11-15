<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOblateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oblate', function (Blueprint $table) {
            $table->increments('oblate_id');
            $table->integer('family_id')->unsigned();
            $table->integer('person_id')->unsigned()->unique();
            $table->integer('ritwik_id')->unsigned();
            $table->integer('creator_id')->unsigned();
            $table->timestamp('created_time')->nullable();
            $table->timestamp('updated_time')->nullable();
            $table->string('comment', 240)->nullable();
        });

        Schema::table('oblate', function (Blueprint $table) {
	    /* Add foreign key to family table. */
            $table->foreign('family_id', 'fk_oblate_family')->references('family_id')->on('family');

	    /* Add foreign key to person table. */
            $table->foreign('person_id', 'fk_oblate_person')->references('person_id')->on('person');

	    /* Add foreign key to ritwik table. */
            $table->foreign('ritwik_id', 'fk_oblate_worker')->references('worker_id')->on('worker');

	    /* Add foreign key to user table. */
            $table->foreign('creator_id', 'fk_oblate_user')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oblate');
    }
}
