<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('referral_code_id')->nullable()->index();
            $table->unsignedBigInteger('referral_user_id')->nullable()->index();

            $table->string('firstname', 50)->nullable();
            $table->string('lastname', 50)->nullable();
            $table->string('national_code', 50)->nullable();
            $table->string('birthdate', 50)->nullable();
            $table->string('father', 50)->nullable();
            $table->string('nationalCardPic', 50)->nullable();

            $table->string('email', 50)->nullable();
            $table->string('email_verified_at')->nullable();
            $table->boolean('email_editing')->default(1);

            $table->string('mobile', 50)->nullable();
            $table->string('mobile_verified_at')->nullable();
            $table->boolean('mobile_editing')->default(1);

            $table->string('phone', 50)->nullable();
            $table->string('phone_verified_at')->nullable();
            $table->boolean('phone_editing')->default(1);

            $table->string('two_fa', 50)->nullable()->comment("mobile | email | google2fa");

            $table->unsignedTinyInteger('personal_info_verified')->nullable();
            $table->string('personal_info_verified_at')->nullable();
            $table->text('disapproval_reason_personal_info')->nullable();

            $table->unsignedBigInteger('country_id')->nullable()->index();
            $table->unsignedBigInteger('province_id')->nullable()->index();
            $table->unsignedBigInteger('city_id')->nullable()->index();
            $table->string('address', 200)->nullable();
            $table->string('postal_code', 25)->nullable();
            $table->unsignedTinyInteger('address_verified')->nullable();
            $table->string('address_verified_at')->nullable();
            $table->text('disapproval_reason_address')->nullable();

            $table->string('auth_pic', 50)->nullable();
            $table->unsignedTinyInteger('auth_pic_verified')->nullable();
            $table->string('auth_pic_verified_at')->nullable();
            $table->text('disapproval_reason_auth_pic')->nullable();

            $table->unsignedBigInteger('user_level_id')->default(1)->nullable()->index();

            $table->boolean('enabled')->default(1)->nullable();

            $table->string('password');

            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });

//        Schema::table('referral_codes', function (Blueprint $table) {
//            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');

//        Schema::table('referral_codes', function (Blueprint $table) {
//            $table->dropForeign('user_id');
//        });
    }
}
