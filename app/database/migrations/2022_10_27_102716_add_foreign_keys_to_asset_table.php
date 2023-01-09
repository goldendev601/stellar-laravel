<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAssetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asset', function (Blueprint $table) {
            $table->foreign(['asset_status_id'], 'fk_asset_asset_status_id')->references(['id'])->on('asset_status')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['seller_id'], 'fk_asset_seller_id')->references(['id'])->on('member')->onUpdate('NO ACTION')->onDelete('SET NULL');
            $table->foreign(['timezone_id'], 'fk_asset_timezone_id')->references(['id'])->on('timezone')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['created_by_id'], 'fk_asset_user_id')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['asset_category_id'], 'pk_asset_asset_category_id')->references(['id'])->on('asset_category')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asset', function (Blueprint $table) {
            $table->dropForeign('fk_asset_asset_status_id');
            $table->dropForeign('fk_asset_seller_id');
            $table->dropForeign('fk_asset_timezone_id');
            $table->dropForeign('fk_asset_user_id');
            $table->dropForeign('pk_asset_asset_category_id');
        });
    }
}
