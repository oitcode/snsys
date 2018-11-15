<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRemittanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remittance', function (Blueprint $table) {
            $table->increments('remittance_id');
            $table->integer('family_id')->unsigned();
            $table->integer('submitter_id')->unsigned();
            $table->date('submitted_date');
            $table->string('delivered_by', 100);
            $table->integer('bank_voucher_id')->unsigned();
            $table->integer('creator_id')->unsigned();
            $table->timestamp('created_time')->nullable();
            $table->timestamp('updated_time')->nullable();
            $table->string('comment', 240)->nullable();
        });

        Schema::table('remittance', function (Blueprint $table) {
	    /* Add foreign key to family table. */
            $table->foreign('family_id', 'fk_remittance_family')->references('family_id')->on('family');

	    /* Add foreign key to oblate table. */
            $table->foreign('submitter_id', 'fk_remittance_oblate')->references('oblate_id')->on('oblate');

	    /* Add foreign key to bank_voucher table. */
            $table->foreign('bank_voucher_id', 'fk_remittance_bank_voucher')->references('bank_voucher_id')->on('bank_voucher');

	    /* Add foreign key to user table. */
            $table->foreign('creator_id', 'fk_remittance_user')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('remittance');
    }
}
