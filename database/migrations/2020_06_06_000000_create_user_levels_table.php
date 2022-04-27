<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_levels', function (Blueprint $table) {
            $table->id();

            $table->string('key')->nullable();
            $table->string('title')->nullable();
            $table->string('requirements')->nullable();

            $table->unsignedInteger('max_daily_deposit_crypto')->nullable();
            $table->unsignedInteger('max_daily_withdraw_crypto')->nullable();

            $table->unsignedInteger('max_daily_deposit_irt')->nullable();
            $table->unsignedInteger('max_daily_withdraw_irt')->nullable();

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
        Schema::dropIfExists('user_levels');
    }
}
