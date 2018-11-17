<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterBankVoucherTableAddCtsCols extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bank_voucher', function (Blueprint $table) {
            /**
	     * Add following columns:
	     *
	     * creator_id
	     * created_time
	     * updated_time
	     */
            
            $table->integer('creator_id')->unsigned()->nullable();
            $table->timestamp('created_time')->nullable();
            $table->timestamp('updated_time')->nullable();
        });

        Schema::table('bank_voucher', function (Blueprint $table) {
	    /* Add foreign key to user table. */
            $table->foreign('creator_id', 'fk_bank_voucher_user')->references('id')->on('user');
            //$table->foreign('creator_id')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bank_voucher', function (Blueprint $table) {
	    /* Drop foreign key constraint */
	    $table->dropForeign('fk_bank_voucher_user');
	    //$table->dropForeign('bank_voucher_creator_id_foreign');

            /**
	     * Drop following columns:
	     *
	     * creator_id
	     * created_time
	     * updated_time
	     */
            
            $table->dropColumn('creator_id');
            $table->dropColumn('created_time');
            $table->dropColumn('updated_time');
        });
    }
}
