<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAssetReceiverTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asset_receiver', function (Blueprint $table) {
            $table->foreign(['asset_id'], 'fk_asset_receiver_asset_id')->references(['id'])->on('asset')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['member_id'], 'fk_asset_receiver_member_id')->references(['id'])->on('member')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asset_receiver', function (Blueprint $table) {
            $table->dropForeign('fk_asset_receiver_asset_id');
            $table->dropForeign('fk_asset_receiver_member_id');
        });
    }
}
