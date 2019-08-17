tf<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('hotel_name');
            $table->text('summary')->nullable();
            $table->text('description');
            $table->enum('type',['small','medium','large','mega'])->default('medium');
            $table->enum('status',['active','inactive'])->default('active');
            $table->string('image');
            $table->enum('city',['kathmandu','pokhara','chitwan','dharan','butwal','nepalgunj'])->default('kathmandu');
            $table->text('address');
            $table->unsignedBigInteger('added_by');
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
        Schema::dropIfExists('hotels');
    }
}
