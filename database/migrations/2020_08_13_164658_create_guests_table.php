<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number');
            $table->string('email')->nullable();
            $table->dateTime('arrival_time');
            $table->dateTime('departure_time');
            $table->string('status')->default('inactive');
            $table->integer('room_fk')->unsigned()->nullable();
            $table->string('nationality');
            $table->string('id_type');
            $table->string('id_number');
            $table->string('extra_note', 255)->nullable();
            $table->integer('guest_house_fk')->unsigned();
            $table->integer('inserted_by')->unsigned(); 
            $table->integer('updated_by')->unsigned();
            $table->timestamps();
            $table->foreign('room_fk')->references('id')->on('rooms');
            $table->foreign('guest_house_fk')->references('id')->on('guest_houses')->onDelete('cascade');
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
        Schema::dropIfExists('guests');
    }
}
