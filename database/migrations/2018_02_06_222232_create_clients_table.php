<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type_identification');
            $table->integer('identification')->unsigned()->unique();
            $table->string('full_name');
            //$table->string('last_name');
            $table->string('email')->unique();
            $table->string('cell_phone');
            $table->string('phone')->nullable();
            $table->string('address');
            $table->date('birth_date');
            $table->char('gender', 1);
            $table->boolean('smoker')->default(false);
            $table->boolean('junkie')->default(false);
            $table->integer('state_id')->unsigned()->default(1);
            $table->softDeletes();
            $table->timestamps();

            //Relations
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
        Schema::dropIfExists('clients');
    }
}
