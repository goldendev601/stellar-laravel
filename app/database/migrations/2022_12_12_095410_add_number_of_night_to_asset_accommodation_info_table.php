<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asset_accommodation_info', function (Blueprint $table) {
            $table->integer('number_of_night')->nullable()->after('number_of_guest');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asset_accommodation_info', function (Blueprint $table) {
            $table->dropColumn('number_of_night');
        });
    }
};
