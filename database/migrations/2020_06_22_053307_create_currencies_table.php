<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable()->unique();
            $table->string('name_fa')->nullable();
            $table->string('name_en')->nullable();
            $table->string('tag_name')->nullable();
            $table->string('pic')->nullable();
            $table->unsignedTinyInteger('decimals')->default(0)->nullable();
            $table->unsignedDouble('withdraw_fee')->nullable();
            $table->unsignedDouble('withdraw_min')->nullable();
            $table->unsignedInteger('deposit_confirm_count')->nullable();
            $table->unsignedTinyInteger('has_networks')->nullable()->default(0);
            $table->string('address_regex')->nullable();
            $table->unsignedInteger('sort')->nullable();
            $table->unsignedTinyInteger('status')->nullable()->default(1);
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
        Schema::dropIfExists('currencies');
    }
}
