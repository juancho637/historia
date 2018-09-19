<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEngagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('engagements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pet_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('state_id')->unsigned()->default(1);
            $table->date('date');
            $table->boolean('home_service')->default(false);
            $table->integer('home_service_shift')->nullable();
            $table->integer('home_service_consecutive')->nullable();
            $table->boolean('engagement_to_be_confirmed')->default(false);
            $table->mediumText('deleted_reason')->nullable();
            $table->softDeletes();
            $table->timestamps();

            //Relations
            $table->foreign('pet_id')->references('id')->on('pets')->onUpdate('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
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
        Schema::dropIfExists('engagements');
    }
}
