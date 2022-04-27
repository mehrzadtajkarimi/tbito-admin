<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_fees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('currency_id')->nullable()->index();
            $table->double('trade_fee')->nullable();
            $table->double('trade_fee_total')->nullable();
            $table->double('withdraw_fee')->nullable();
            $table->double('withdraw_fee_total')->nullable();
            $table->double('deposit_fee')->nullable();
            $table->double('deposit_fee_total')->nullable();
            $table->double('site_transaction_fee')->nullable();
            $table->double('site_transaction_fee_total')->nullable();
            $table->double('site_transaction')->nullable();
            $table->double('site_transaction_total')->nullable();
            $table->double('available')->nullable();
            $table->double('available_total')->nullable();
            $table->timestamp('date')->nullable();
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
        Schema::dropIfExists('site_fees');
    }
}
