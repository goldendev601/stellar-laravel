<?php

use App\ModelsExtended\MemberStatus;
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
        Schema::table('member', function (Blueprint $table) {
            $table->dropColumn('is_active');
            $table->unsignedBigInteger('member_status_id')->default(MemberStatus::Active)
                ->index('fk_member_member_status_id');
            $table->foreign(['member_status_id'], 'fk_member_member_status_id')->references(['id'])->on('member_status')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('member', function (Blueprint $table) {
            $table->boolean('is_active')->default(true);
            $table->dropForeign('fk_member_member_status_id');
            $table->dropColumn('member_status_id');
        });
    }
};
