<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoogle2fasTable extends Migration
{
    /**php
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('google2fas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->unsignedBigInteger('admin_id')->nullable()->index();

            $table->text('secret_key')->nullable();

            $table->boolean('resetted')->nullable()->default(0);
            $table->timestamp('resetted_at')->nullable();

            $table->boolean('confirmed')->nullable()->default(0);
            $table->timestamp('confirmed_at')->nullable();

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
        Schema::dropIfExists('google2fa_keys');
    }
}
