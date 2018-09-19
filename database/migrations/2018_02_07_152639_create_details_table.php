<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('purchase_order_id')->unsigned();
            //$table->integer('quotation_id')->unsigned()->default(1);
            $table->double('quantity');
            $table->double('tax_percentage');
            $table->double('value');
            $table->softDeletes();
            $table->timestamps();

            //Relations
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade');
            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders')->onUpdate('cascade');
            //$table->foreign('quotation_id')->references('id')->on('quotations')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('details');
    }
}
