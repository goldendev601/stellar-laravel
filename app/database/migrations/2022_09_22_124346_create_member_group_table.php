<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_group', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('contact_group_id')->index('fk_member_group_contact_group_id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->unique(['member_id', 'contact_group_id'], 'uq_member_group_member_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_group');
    }
}
