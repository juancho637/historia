<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDosagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('percentage_used')->unsigned();
            $table->string('cellar');
            $table->integer('detail_id')->unsigned()->default();
            $table->integer('stock_id')->unsigned()->default();
            $table->integer('state_id')->unsigned()->default(1);
            $table->softDeletes();
            $table->timestamps();

            //Relations
            $table->foreign('detail_id')->references('id')->on('details')->onUpdate('cascade');
            $table->foreign('stock_id')->references('id')->on('stocks')->onUpdate('cascade');
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
        Schema::dropIfExists('dosages');
    }
}
