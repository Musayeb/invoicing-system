<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {

            $table->BigIncrements('id');
            
            $table->Biginteger('client_id')->unsigned()->nullable();
            $table->foreign('client_id')->references('client_id')->on('clients')->onDelete('cascade');

            $table->text('description')->nullable();
            $table->string('status')->default('noview');
            $table->date('read')->nullable();
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
        Schema::dropIfExists('notifications');
    }
}
