<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('guest_fk')->unsigned();
            $table->integer('service_fk')->unsigned();
            $table->integer('inserted_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->timestamps();
            $table->foreign('guest_fk')->references('id')->on('guests')->onDelete('cascade');
            $table->foreign('service_fk')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('inserted_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guest_services');
    }
}
