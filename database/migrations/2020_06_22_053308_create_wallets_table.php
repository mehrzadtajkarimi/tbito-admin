<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('currency_id')->nullable()->index();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->unique(['currency_id', 'user_id']);
            $table->unsignedDouble('amount')->default(0);
            $table->unsignedDouble('tradable_amount')->default(0);
            $table->string('address')->nullable()->index();
            $table->string('tag')->nullable()->index();
            $table->boolean('status')->nullable()->default(1);
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
        Schema::dropIfExists('wallets');
    }
}
