<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('breed_id')->unsigned();
            $table->integer('state_id')->unsigned()->default(1);
            $table->string('name');
            $table->float('weight', 6, 2)->unsigned();
            $table->date('birth_date');
            $table->char('gender', 1);
            $table->string('reproductive_status');
            $table->date('date_death')->nullable();
            $table->text('description_death')->nullable();
            $table->softDeletes();
            $table->timestamps();

            //Relations
            $table->foreign('breed_id')->references('id')->on('breeds')->onUpdate('cascade');
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
        Schema::dropIfExists('pets');
    }
}
