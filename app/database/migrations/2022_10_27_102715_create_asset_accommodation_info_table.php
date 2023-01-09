<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetAccommodationInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_accommodation_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('asset_id')->unique('uq_asset_accommodation_info');
            $table->string('guest_name', 150)->nullable();
            $table->integer('number_of_guest')->nullable();
            $table->string('confirmation_number', 150)->nullable();
            $table->string('venue_phone', 50)->nullable();
            $table->string('cancellation_cost', 50)->nullable();
            $table->string('website', 250)->nullable();
            $table->string('cancellation_policy', 250)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_accommodation_info');
    }
}
