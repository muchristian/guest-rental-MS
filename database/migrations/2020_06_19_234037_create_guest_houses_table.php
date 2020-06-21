<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_houses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slogan')->nullable();
            $table->string('logo', 255)->nullable();
            $table->string('location');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
        Schema::table('users', function($table) {
            $table->foreign('guest_house_fk')->references('id')->on('guest_houses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guest_houses');
    }
}
