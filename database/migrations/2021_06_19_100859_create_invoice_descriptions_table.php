<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_descriptions', function (Blueprint $table) {
            $table->bigIncrements('invoice_info_id');
            
            $table->text('description');

            $table->Biginteger('invoice_id')->unsigned()->nullable();
            $table->foreign('invoice_id')->references('invoice_id')->on('invoices');
            
            $table->bigInteger('amount');
            $table->bigInteger('qty');

            $table->Biginteger('author')->unsigned()->nullable();
            $table->foreign('author')->references('id')->on('users');



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
        Schema::dropIfExists('invoice_descriptions');
    }
}
