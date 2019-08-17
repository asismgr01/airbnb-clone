<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('activity_id');
            $table->tinyInteger('rate')->default(1);
            $table->text('review');
            $table->enum('status',['active','inactive'])->default('active');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('CASCADE');
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
        Schema::dropIfExists('activity_reviews');
    }
}
