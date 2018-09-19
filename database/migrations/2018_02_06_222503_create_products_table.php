<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('value')->unsigned();
            $table->float('tax_percentage', 5, 2)->unsigned();
            $table->string('description')->nullable();
            $table->string('type');
            $table->integer('state_id')->unsigned()->default(1);
            $table->integer('category_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            //Relations
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade');
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
        Schema::dropIfExists('products');
    }
}
