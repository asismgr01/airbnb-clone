<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('hotel_id');
            $table->tinyInteger('rate')->default(0);
            $table->text('review')->nullable();
            $table->enum('status', ['active','inactive'])->default('active');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('CASCADE');

            $table->timestamps();
        });


/*        Schema::table('hotel_reviews', function(Blueprint $table){
            $table->string('abc')->after('status');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotel_reviews');

/*        Schema::table('hotel_reviews', function(Blueprint $table){
            $table->dropColumn('abc');
        });
*/
    }
}
