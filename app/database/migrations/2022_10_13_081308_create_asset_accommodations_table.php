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
        Schema::create('asset_accommodations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('asset_id');
            $table->string("check_in")->nullable();
            $table->string("check_out")->nullable();
            $table->string("confirmation_number")->nullable();
            $table->string("guest_name")->nullable();
            $table->integer("number_of_guests")->nullable();
            $table->string("venue_phone")->nullable();
            $table->string("cancellation_cost")->nullable();
            $table->string("website")->nullable();
            $table->string("cancellation_policy")->nullable();
            $table->string("notes")->nullable();
            $table->timestamps();

            $table->foreign('asset_id')->references('id')->on('assets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_accommodations');
    }
};
