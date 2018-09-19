<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailEngagementUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_engagement_user', function (Blueprint $table) {
            $table->integer('detail_engagement_id')->unsigned();
            $table->integer('user_id')->unsigned();

            //Relations
            $table->foreign('detail_engagement_id')->references('id')->on('detail_engagements');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_engagement_user');
    }
}
