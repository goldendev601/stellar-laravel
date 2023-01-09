<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAssetCostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asset_cost', function (Blueprint $table) {
            $table->foreign(['asset_id'], 'fk_asset_cost_asset_id')->references(['id'])->on('asset')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['currency_type_id'], 'fk_asset_cost_currency_type_id')->references(['id'])->on('currency_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asset_cost', function (Blueprint $table) {
            $table->dropForeign('fk_asset_cost_asset_id');
            $table->dropForeign('fk_asset_cost_currency_type_id');
        });
    }
}
