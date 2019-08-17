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
            $table->enum('room_type',['single','double','triple','quad','queen','king']);
            $table->string('size');
            $table->string('beds')->nullable();
            $table->float('price');
            $table->float('discount')->nullable()->default(0);
            $table->unsignedBigInteger('hotel_id')->nullable();
            $table->unsignedBigInteger('added_by');
            $table->enum('status',['available','unavailable'])->default('available');
            $table->text('summary')->nullable();
            $table->text('room_details');

            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('CASCADE');
            $table->foreign('added_by')->references('id')->on('users')->onDelete('CASCADE');
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
        Schema::dropIfExists('rooms');
        
    }
}
