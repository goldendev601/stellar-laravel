<?php

use App\ModelsExtended\Asset;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asset', function (Blueprint $table) {
            $table->uuid('unique_id')->nullable();
            $table->string('bitly_id', 250)->nullable();
        });

        // Update old records
        Asset::all()->each(function (Asset $asset){
            $unique_id = Str::uuid()->toString();
           DB::statement("update asset set unique_id='$unique_id' where id=" . $asset->id);
        });

        // make not nullable
        Schema::table('asset', function (Blueprint $table) {
            $table->uuid('unique_id')->nullable(false)->change();
            $table->unique('unique_id', 'uq_asset_unique_id');
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
            $table->dropColumn('unique_id');
            $table->dropColumn('bitly_id');
        });
    }
};
