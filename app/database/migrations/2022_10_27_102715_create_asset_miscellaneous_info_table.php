<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetMiscellaneousInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_miscellaneous_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('asset_id')->unique('uq_asset_miscellaneous_info');
            $table->string('display_date', 150)->nullable();
            $table->string('event_name', 250)->nullable();
            $table->string('event_type', 250)->nullable();
            $table->string('ticket_holder', 250)->nullable();
            $table->integer('number_of_seats')->nullable();
            $table->string('seat_area', 50)->nullable();
            $table->string('multiple_locations', 550)->nullable();
            $table->string('total_paid', 50)->nullable();
            $table->string('venue_layout', 250)->nullable();
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
        Schema::dropIfExists('asset_miscellaneous_info');
    }
}
