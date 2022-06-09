<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->BigIncrements('project_id');
            $table->string('project_name');
            
            $table->Biginteger('client_id')->unsigned()->nullable();
            $table->foreign('client_id')->references('client_id')->on('clients');

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('status');
            $table->Biginteger('budget');
            $table->string('currency');
            $table->longText('description')->nullable();           
 
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
        Schema::dropIfExists('projects');
    }
}
