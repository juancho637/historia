<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('identification')->unsigned()->unique();
            $table->string('name');
            $table->string('last_name');
            $table->string('full_name');
            $table->string('professional_identification')->nullable();
            $table->string('address');
            $table->string('cell_phone');
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('password_change')->default(false);
            $table->integer('state_id')->unsigned()->default(1);
            $table->integer('occupation_id')->unsigned()->default(1);
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();

            // Relations
            $table->foreign('state_id')->references('id')->on('states')->onUpdate('cascade');
            $table->foreign('occupation_id')->references('id')->on('occupations')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
