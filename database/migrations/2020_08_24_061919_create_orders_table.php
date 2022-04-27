<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->unsignedBigInteger('market_id')->nullable()->index();
            $table->unsignedBigInteger('currency1_id')->nullable()->index();
            $table->unsignedBigInteger('currency2_id')->nullable()->index();
            $table->unsignedBigInteger('currency_fee_id')->nullable()->index();
            $table->unsignedTinyInteger('type')->nullable();
            $table->unsignedTinyInteger('side')->nullable();
            $table->unsignedTinyInteger('status')->nullable();
            $table->unsignedDouble('amount')->nullable();
            $table->unsignedDouble('price')->nullable();
            $table->unsignedDouble('amount_filled')->nullable()->default(0);
            $table->unsignedDouble('price_avg')->nullable();
            $table->unsignedFloat('fee_percent')->nullable();
            $table->unsignedFloat('fee_percent_user')->nullable();
            $table->unsignedFloat('fee_percent_site')->nullable();
            $table->unsignedFloat('referral_percent')->nullable();
            $table->unsignedFloat('referral_percent_user')->nullable();
            $table->unsignedFloat('referral_percent_friend')->nullable();
            $table->unsignedDouble('fee_user')->nullable();
            $table->unsignedDouble('fee_site')->nullable();
            $table->unsignedTinyInteger('consume_status')->nullable()->default(0);
            $table->tinyInteger('is_robot')->nullable()->default(0);
            $table->unsignedBigInteger('robot_order_id')->nullable();
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
        Schema::dropIfExists('orders');
    }
}

