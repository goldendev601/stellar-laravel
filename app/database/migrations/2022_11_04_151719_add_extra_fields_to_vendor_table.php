<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'vendor', function (Blueprint $table) {
                $table->bigInteger('asset_category_id')->default(\App\ModelsExtended\AssetCategory::Accommodation)->unsigned();
                $table->string('phone', 20)->nullable();
                $table->string('email', 255)->nullable();
                $table->foreign(['asset_category_id'], 'fk_asset_category_id')->references(['id'])->on('asset_category')->onUpdate('CASCADE')->onDelete('NO ACTION');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'vendor', function (Blueprint $table) {
                //
            }
        );
    }
};
