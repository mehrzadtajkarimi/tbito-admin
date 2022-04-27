<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletAddressesTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('currency_id')->nullable()->index();
            $table->unsignedBigInteger('code')->nullable()->index();
            $table->string('address')->nullable()->index();
            $table->string('tag')->nullable()->index();
            $table->unsignedDouble('balance')->nullable()->default(0);
            $table->unsignedTinyInteger('used')->nullable()->default(0);
            $table->unique(['currency_id', 'address', 'tag']);
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
        Schema::dropIfExists('wallet_addresses');
    }
}
