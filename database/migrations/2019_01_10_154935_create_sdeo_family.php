<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSdeoFamily extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sdeo_family', function (Blueprint $table) {
            $table->increments('sdeo_family_id');
            $table->bigInteger('sdeo_family_code')->unique();
            $table->string('address', 200);
        });

        Schema::create('sdeo_person', function (Blueprint $table) {
            $table->increments('sdeo_person_id');
            $table->string('sdeo_person_name', 100);
            $table->bigInteger('sdeo_person_family_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sdeo_family');
        Schema::dropIfExists('sdeo_person');
    }
}
