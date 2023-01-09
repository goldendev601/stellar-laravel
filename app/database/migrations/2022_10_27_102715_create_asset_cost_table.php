<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetCostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_cost', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('asset_id')->unique('uq_asset_cost');
            $table->unsignedBigInteger('currency_type_id')->index('fk_asset_cost_currency_type_id');
            $table->decimal('amount', 15);
            $table->decimal('usd_amount', 15);
            $table->string('cost_details')->nullable();
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
        Schema::dropIfExists('asset_cost');
    }
}
