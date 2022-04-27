<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('currency_id')->nullable()->index();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->unsignedTinyInteger('type')->nullable();
            $table->tinyInteger('sign')->default(1)->comment(" deposit: +1 | withdraw: -1");
            $table->unsignedDouble('amount')->nullable()->default(0);
            $table->unsignedDouble('balance')->nullable();
            $table->nullableMorphs('transactionable');
            $table->text('description')->nullable();
            $table->unsignedTinyInteger('creation_type')->nullable()->default(1);
            $table->longText('hash')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
