<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guides', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guide_id')->nullable()->index();
            $table->string('name')->nullable();
            $table->string('title')->nullable();
            $table->text('text')->nullable();
            $table->unsignedInteger('sort')->default(0);
            $table->unsignedInteger('views')->default(0);
            $table->unsignedTinyInteger('display')->default(1);
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
        Schema::dropIfExists('guides');
    }
}
