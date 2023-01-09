<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToMemberGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('member_group', function (Blueprint $table) {
            $table->foreign(['member_id'], 'fk_member_group_member_id')->references(['id'])->on('member')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['contact_group_id'], 'fk_member_group_contact_group_id')->references(['id'])->on('contact_group')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('member_group', function (Blueprint $table) {
            $table->dropForeign('fk_member_group_member_id');
            $table->dropForeign('fk_member_group_contact_group_id');
        });
    }
}
