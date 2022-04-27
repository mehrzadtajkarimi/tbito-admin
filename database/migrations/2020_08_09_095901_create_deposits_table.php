<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->unsignedBigInteger('currency_id')->nullable()->index();
            $table->unsignedBigInteger('wallet_id')->nullable()->index();
            $table->unsignedBigInteger('bank_account_id')->nullable()->index();
            $table->unsignedTinyInteger('type')->nullable();
            $table->unsignedDouble('amount')->nullable();
            $table->unsignedDouble('fee')->nullable();
            $table->double('fee_site')->nullable();
            $table->string('txid')->nullable()->index();
            $table->unsignedBigInteger('gateway_id')->nullable()->index();
            $table->string('tracking_code')->nullable();
            $table->json('extra_data')->nullable();
            $table->unsignedTinyInteger('status')->nullable();
            $table->string('confirmed_by_network_at')->nullable();
            $table->string('confirmed_by_site_at')->nullable();
            $table->unsignedTinyInteger('desc')->nullable();
            $table->text('description')->nullable();
            $table->unsignedTinyInteger('creation_type')->nullable()->default(1);
            $table->unsignedTinyInteger('confirm_type')->nullable()->default(1);
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
        Schema::dropIfExists('deposits');
    }
}
