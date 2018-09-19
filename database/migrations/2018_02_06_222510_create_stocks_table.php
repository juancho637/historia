<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchase_amount')->unsigned();
            $table->integer('stock_min')->unsigned();
            $table->integer('stock')->unsigned();
            $table->date('due_date');
            $table->integer('lot')->unsigned();
            //$table->string('presentation');
            //$table->string('concentration');
            $table->integer('product_id')->unsigned()->default();
            $table->integer('provider_id')->unsigned()->default();
            $table->integer('state_id')->unsigned()->default(1);
            $table->softDeletes();
            $table->timestamps();

            //Relations
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade');
            $table->foreign('provider_id')->references('id')->on('providers')->onUpdate('cascade');
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
        Schema::dropIfExists('stocks');
    }
}
