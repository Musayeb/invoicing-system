<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->BigIncrements('incomes_id');
            $table->Biginteger('invoice_id')->unsigned()->nullable();
            $table->foreign('invoice_id')->references('invoice_id')->on('invoices');
            $table->Biginteger('amount');
            $table->string('payment_method');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incomes');
    }
}
