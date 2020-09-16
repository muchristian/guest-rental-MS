<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('room_name');
            $table->string('room_type');
            $table->string('status')->default('inactive');
            $table->string('comment', 255)->nullable();
            $table->integer('guest_house_fk')->unsigned();
            $table->integer('inserted_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->timestamps();
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
        Schema::dropIfExists('rooms');
    }
}
