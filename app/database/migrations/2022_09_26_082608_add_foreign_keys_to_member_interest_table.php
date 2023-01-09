<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToMemberInterestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('member_interest', function (Blueprint $table) {
            $table->foreign(['member_id'], 'fk_member_interest_member_id')->references(['id'])->on('member')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('member_interest', function (Blueprint $table) {
            $table->dropForeign('fk_member_interest_member_id');
        });
    }
}
