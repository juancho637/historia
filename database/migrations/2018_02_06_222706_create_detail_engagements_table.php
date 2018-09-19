<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailEngagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_engagements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('engagement_id')->unsigned();
            $table->integer('service_id')->unsigned();
            $table->integer('state_id')->unsigned()->default(1);
            $table->integer('assigned_shift')->nullable();
            $table->boolean('consultation_without_cost')->default(false);
            $table->time('end_time')->nullable();
            $table->time('start_time')->nullable();
            $table->mediumText('description')->nullable();
            $table->softDeletes();
            $table->timestamps();

            //Relations
            $table->foreign('engagement_id')->references('id')->on('engagements');
            $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('state_id')->references('id')->on('states')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_engagements');
    }
}
