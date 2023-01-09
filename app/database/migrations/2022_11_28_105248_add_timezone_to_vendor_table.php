<?php

use App\ModelsExtended\Timezone;
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
        Schema::table('vendor', function (Blueprint $table) {

            // this only creates the column but doesn't create the constraint [ timezone_id ]
            $table->foreignIdFor(Timezone::class)->default(Timezone::UTC)->after('city');

        });

        Schema::table('vendor', function (Blueprint $table) {
            $table->foreign(['timezone_id'], 'fk_vendor_timezone_id')->references(['id'])->on('timezone')
                ->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendor', function (Blueprint $table) {
            $table->dropForeign('fk_vendor_timezone_id');
            $table->dropColumn('timezone_id');
        });
    }
};
