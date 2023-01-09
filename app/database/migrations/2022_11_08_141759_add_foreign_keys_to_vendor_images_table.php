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
            'vendor_images', function (Blueprint $table) {
                $table->foreign(['vendor_id'], 'fk_vendor_images_id')->references(['id'])->on('vendor')->onUpdate('CASCADE')->onDelete('CASCADE');
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
            'vendor_images', function (Blueprint $table) {
                //
            }
        );
    }
};
