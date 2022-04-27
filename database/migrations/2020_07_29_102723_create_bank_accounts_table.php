<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('bank_name')->nullable();
            $table->string('card_num')->nullable();
            $table->string('card_name')->nullable();
            $table->string('iban_num')->nullable();
            $table->string('iban_name')->nullable();
            $table->unsignedTinyInteger('verified')->nullable();
            $table->string('verified_at')->nullable();
            $table->text('disapproval_reason')->nullable();
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
        Schema::dropIfExists('bank_accounts');
    }
}
