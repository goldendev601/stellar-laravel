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
        Schema::table('vendor_images', function (Blueprint $table) {
            $table->renameColumn('image_url', 'image_relative_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendor_images', function (Blueprint $table) {
            $table->renameColumn('image_relative_url', 'image_url');
        });
    }
};
