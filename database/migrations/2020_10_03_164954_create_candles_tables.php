<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandlesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('market_id')->nullable()->index();
            $table->unsignedDouble('open')->nullable();
            $table->unsignedDouble('close')->nullable();
            $table->unsignedDouble('min')->nullable();
            $table->unsignedDouble('max')->nullable();
            $table->unsignedDouble('vol')->nullable();
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
        Schema::dropIfExists('candles');
    }
}
