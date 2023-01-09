<?php

use App\ModelsExtended\AssetReceiver;
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
        AssetReceiver::query()->delete(); // clear table
        Schema::table('asset_receiver', function (Blueprint $table) {
            $table->string('message_bird_id', 100)->nullable(false);
            $table->string('msisdn', 50)->nullable(false);
            $table->string('status', 50)->nullable(false);
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
            $table->dropColumn('message_bird_id');
            $table->dropColumn('msisdn');
            $table->dropColumn('status');
        });
    }
};
