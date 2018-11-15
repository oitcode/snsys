<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankVoucherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_voucher', function (Blueprint $table) {
            $table->increments('bank_voucher_id');
            $table->string('voucher_number', 200)->unique();
            $table->date('deposit_date');
            $table->decimal('amount', 8, 2);
            $table->string('comment', 240)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_voucher');
    }
}
