<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('title');
            $table->text('summary')->nullable();
            $table->text('description');
            $table->unsignedBigInteger('added_by');
            $table->float('price');
            $table->float('discount')->nullable()->default(0);
            $table->string('duration')->nullable();
            $table->enum('city',['kathmandu','pokhara','chitwan','dharan','butwal','nepalgunj'])->default('kathmandu');
            $table->enum('status',['active','inactive'])->default('active');
            $table->text('notice')->nullable();
            $table->enum('type',['']);
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
        Schema::dropIfExists('activities');
    }
}
