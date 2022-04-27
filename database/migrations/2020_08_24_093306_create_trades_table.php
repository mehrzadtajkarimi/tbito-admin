<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('market_id')->nullable()->index();
            $table->unsignedBigInteger('currency1_id')->nullable()->index();
            $table->unsignedBigInteger('currency2_id')->nullable()->index();
            $table->unsignedBigInteger('currency_buyer_fee_id')->nullable()->index();
            $table->unsignedBigInteger('currency_seller_fee_id')->nullable()->index();
            $table->unsignedBigInteger('buyer_id')->nullable()->index();
            $table->unsignedBigInteger('seller_id')->nullable()->index();
            $table->unsignedBigInteger('buyer_order_id')->nullable()->index();
            $table->unsignedBigInteger('seller_order_id')->nullable()->index();
            $table->unsignedDouble('buyer_fee')->nullable();
            $table->unsignedDouble('buyer_fee_site')->nullable();
            $table->unsignedDouble('seller_fee')->nullable();
            $table->unsignedDouble('seller_fee_site')->nullable();
            $table->unsignedDouble('amount')->nullable();
            $table->unsignedDouble('price')->nullable();
            $table->unsignedDouble('trade_irt_value')->nullable();
            $table->unsignedDouble('trade_base_value')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trades');
    }
}
