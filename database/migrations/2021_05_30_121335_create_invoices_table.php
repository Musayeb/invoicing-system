<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
  
            $table->BigIncrements('invoice_id');
            $table->string('invoice_number');

            $table->Biginteger('project_id')->unsigned()->nullable();
            $table->foreign('project_id')->references('project_id')->on('projects')->onDelete('cascade');
            $table->string('status');
            $table->string('file_path')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
