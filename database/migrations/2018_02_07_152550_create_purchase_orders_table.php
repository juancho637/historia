<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('balance_id')->unsigned()->nullable();
            $table->integer('pet_id')->unsigned();
            $table->integer('engagement_id')->unsigned();
            $table->integer('state_id')->unsigned()->default(1);
            $table->integer('consecutive')->nullable();
            $table->double('subtotal');
            $table->double('taxes');
            $table->double('total_value');
            $table->softDeletes();
            $table->timestamps();

            //Relations
            $table->foreign('client_id')->references('id')->on('clients')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('balance_id')->references('id')->on('balances')->onUpdate('cascade');
            $table->foreign('pet_id')->references('id')->on('pets')->onUpdate('cascade');
            $table->foreign('engagement_id')->references('id')->on('engagements')->onUpdate('cascade');
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
        Schema::dropIfExists('purchase_orders');
    }
}
