<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('otp',10)->nullable();
            $table->string('otp_type')->nullable()->comment("mobile | email | phone ");
            $table->string('receiver')->nullable()->comment("value for receiver_type e.g. example@gmail.com");
            $table->timestamp('expires_at')->nullable();
            $table->timestamp('resendable_at')->nullable();
            $table->timestamp('used_at')->nullable();
            $table->tinyInteger('try_count')->default(0);
            $table->boolean('match_status')->nullable();
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
        Schema::dropIfExists('otps');
    }
}
