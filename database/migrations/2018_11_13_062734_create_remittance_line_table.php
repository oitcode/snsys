<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRemittanceLineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remittance_line', function (Blueprint $table) {
            $table->increments('remittance_line_id');
	    $table->integer('remittance_id')->unsigned();
	    $table->integer('oblate_id')->unsigned();
	    $table->decimal('swastyayani', 8, 2)->nullable();
	    $table->decimal('istavrity', 8, 2);
	    $table->decimal('acharyavrity', 8, 2)->nullable();
	    $table->decimal('dakshina', 8, 2)->nullable();
	    $table->decimal('sangathani', 8, 2)->nullable();
	    $table->decimal('ananda_bazar', 8, 2)->nullable();
	    $table->decimal('pranami', 8, 2)->nullable();
	    $table->decimal('swastyayani_awasista', 8, 2)->nullable();
	    $table->decimal('ritwiki', 8, 2)->nullable();
	    $table->decimal('utsav', 8, 2)->nullable();
	    $table->decimal('diksha_pranami', 8, 2)->nullable();
	    $table->decimal('acharya_pranami', 8, 2)->nullable();
	    $table->decimal('parivrity', 8, 2)->nullable();
	    $table->decimal('misc', 8, 2)->nullable();

	    $table->integer('creator_id')->unsigned();
            $table->timestamp('created_time')->nullable();
            $table->timestamp('updated_time')->nullable();
            $table->string('comment', 240)->nullable();
        });

        Schema::table('remittance_line', function (Blueprint $table) {
	    /* Add foreign key to remittance table. */
            $table->foreign('remittance_id', 'fk_remittance_line_remittance')->references('remittance_id')->on('remittance');

	    /* Add foreign key to oblate table. */
            $table->foreign('oblate_id', 'fk_remittance_line_oblate')->references('oblate_id')->on('oblate');

	    /* Add foreign key to user table. */
            $table->foreign('creator_id', 'fk_remittance_line_user')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('remittance_line');
    }
}
