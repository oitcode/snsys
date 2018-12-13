<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamilyCodeFixTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_code_fix', function (Blueprint $table) {
            $table->increments('family_code_fix_id');
            $table->integer('family_id')->unsigned();
            $table->bigInteger('err_family_code')->unique();
            $table->timestamp('created_time')->nullable();
            $table->timestamp('updated_time')->nullable();
            $table->string('comment', 240)->nullable();
        });

        Schema::table('family_code_fix', function (Blueprint $table) {
	    /* Add foreign key to family table. */
            $table->foreign('family_id', 'fk_family_code_fix_family')->references('family_id')->on('family');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('family_code_fix');
    }
}
