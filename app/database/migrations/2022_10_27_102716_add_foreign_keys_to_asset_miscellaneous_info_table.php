<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAssetMiscellaneousInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asset_miscellaneous_info', function (Blueprint $table) {
            $table->foreign(['asset_id'], 'fk_asset_miscellaneous_info_asset_id')->references(['id'])->on('asset')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asset_miscellaneous_info', function (Blueprint $table) {
            $table->dropForeign('fk_asset_miscellaneous_info_asset_id');
        });
    }
}
