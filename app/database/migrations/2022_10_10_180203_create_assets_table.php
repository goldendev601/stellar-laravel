<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('asset_category')->onDelete('cascade');
            $table->string("name")->nullable();
            $table->string("venue")->nullable();
            $table->text("address")->nullable();
            $table->string("seller")->nullable();
            $table->string("status")->nullable();
            $table->string("cost")->nullable();
            $table->string("date")->nullable();
            $table->string("deadline")->nullable();
            $table->string("timezone")->nullable();
            $table->text("description")->nullable();
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
        Schema::dropIfExists('assets');
    }
};
