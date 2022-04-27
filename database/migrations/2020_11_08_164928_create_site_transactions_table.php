<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('currency_id')->nullable()->index();
            $table->double('amount')->nullable();
            $table->double('fee')->nullable();
            $table->unsignedTinyInteger('type')->nullable();
            $table->unsignedTinyInteger('destination')->nullable();
            $table->string('date')->nullable();
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
        Schema::dropIfExists('site_transactions');
    }
}
