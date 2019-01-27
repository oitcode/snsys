<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StartJournal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
		| Create account table
		|
		*/
        Schema::create('account', function (Blueprint $table) {
            $table->increments('account_id');
            $table->string('name', 50);
            $table->string('remarks', 240)->nullable();

            $table->integer('creator_id')->unsigned();
            $table->timestamp('created_time')->nullable();
            $table->timestamp('updated_time')->nullable();
            $table->string('comment', 240)->nullable();
        });

        Schema::table('account', function (Blueprint $table) {
	        /* Add foreign key to user table. */
            $table->foreign('creator_id')->references('id')->on('user');
        });


        /*
		| Create journal_entry table
		|
		*/
        Schema::create('journal_entry', function (Blueprint $table) {
            $table->increments('journal_entry_id');
            $table->string('particulars', 240);
            $table->integer('remittance_id')->unsigned()->nullable();
            $table->integer('dr_account_id')->unsigned();
            $table->integer('dr_amount');
            $table->integer('cr_account_id')->unsigned();
            $table->integer('cr_amount');
            $table->string('remarks', 240)->nullable();

            $table->integer('creator_id')->unsigned();
            $table->timestamp('created_time')->nullable();
            $table->timestamp('updated_time')->nullable();
            $table->string('comment', 240)->nullable();
        });

        Schema::table('journal_entry', function (Blueprint $table) {
			/* Foreign key to remittance */
            $table->foreign('remittance_id')->references('remittance_id')->on('remittance');

			/* Foreign key to dr account */
            $table->foreign('dr_account_id')->references('account_id')->on('account');

			/* Foreign key to cr account */
            $table->foreign('cr_account_id')->references('account_id')->on('account');

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
        Schema::dropIfExists('journal_entry');
        Schema::dropIfExists('account');
    }
}
