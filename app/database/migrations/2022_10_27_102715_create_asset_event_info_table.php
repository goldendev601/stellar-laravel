<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetEventInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_event_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('asset_id')->unique('uq_asset_event_info');
            $table->string('event_name', 250)->nullable();
            $table->string('event_type', 250)->nullable();
            $table->string('ticket_holder', 250)->nullable();
            $table->integer('number_of_seats')->nullable();
            $table->string('seat_area', 50)->nullable();
            $table->string('venue_layout', 250)->nullable();
            $table->string('cancellation_policy', 250)->nullable();
            $table->string('total_paid', 50)->nullable();
            $table->text('venue_amenities')->nullable();
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
        Schema::dropIfExists('asset_event_info');
    }
}
