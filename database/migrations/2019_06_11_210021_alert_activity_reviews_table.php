<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlertActivityReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activity_reviews',function(Blueprint $table){
              $table->string('name')->nullable()->after('id');
              $table->string('email')->nullable()->before('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activity_reviews',function(Blueprint $table){
              $table->dropColumn('name');
              $table->dropColumn('email');
        });
    }
}
