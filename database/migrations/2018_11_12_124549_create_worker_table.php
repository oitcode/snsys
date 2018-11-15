<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worker', function (Blueprint $table) {
            $table->increments('worker_id');
            $table->string('worker_code', 45)->nullable();
            $table->integer('person_id')->unsigned();
            $table->string('type', 1);
            $table->integer('creator_id')->unsigned();
            $table->timestamp('created_time')->nullable();
            $table->timestamp('updated_time')->nullable();
            $table->string('comment', 240)->nullable();
        });

        Schema::table('worker', function (Blueprint $table) {
	    /* Add foreign key to person table. */
            $table->foreign('person_id')->references('person_id')->on('person');

	    /* Add foreign key to user table. */
            $table->foreign('creator_id')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('worker');
    }
}
