
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraws', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->unsignedBigInteger('currency_id')->nullable()->index();
            $table->unsignedBigInteger('currency_network_id')->nullable()->index();
            $table->unsignedBigInteger('bank_account_id')->nullable()->index();
            $table->unsignedTinyInteger('type')->nullable();
            $table->string('address')->nullable()->index();
            $table->string('tag')->nullable()->index();
            $table->string('txid')->nullable()->index(); //
            $table->unsignedDouble('amount')->nullable();
            $table->unsignedDouble('fee')->nullable();
            $table->unsignedDouble('fee_real')->nullable(); //
            $table->double('fee_site')->nullable(); // fee - fee_real
            $table->unsignedTinyInteger('creation_type')->nullable()->default(1); //
            $table->unsignedTinyInteger('payment_type')->nullable()->default(2); //
            $table->unsignedTinyInteger('status')->nullable()->default(1); //
            $table->unsignedBigInteger('gateway_id')->nullable()->index();
            $table->string('tracking_code')->nullable(); //
            $table->json('extra_data')->nullable(); //
            $table->string('confirmed_by_site_at')->nullable(); //
            $table->string('confirmed_by_network_at')->nullable(); //
            $table->text('disapproval_reason')->nullable(); //
            $table->unsignedTinyInteger('desc')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('withdraws');
    }
}
