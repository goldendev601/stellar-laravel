<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('created_by_id')->index('fk_asset_user_id');
            $table->unsignedBigInteger('asset_category_id')->index('pk_asset_asset_category_id');
            $table->unsignedBigInteger('asset_status_id')->index('fk_asset_asset_status_id');
            $table->unsignedBigInteger('seller_id')->nullable()->index('fk_asset_seller_id');
            $table->string('name')->nullable();
            $table->string('venue_name')->nullable();
            $table->string('venue_address')->nullable();
            $table->dateTime('check_in_datetime');
            $table->date('check_out_date')->nullable();
            $table->dateTime('deadline_datetime');
            $table->unsignedBigInteger('timezone_id')->index('fk_asset_timezone_id');
            $table->text('description')->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('asset');
    }
}
