<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetDiningInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_dining_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('asset_id')->unique('uq_asset_dining_info');
            $table->string('guest_name', 150)->nullable();
            $table->integer('number_of_guest')->nullable();
            $table->string('guest_email', 250)->nullable();
            $table->string('guest_phone', 250)->nullable();
            $table->text('menu_highlights')->nullable();
            $table->string('venue_phone', 50)->nullable();
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
        Schema::dropIfExists('asset_dining_info');
    }
}
