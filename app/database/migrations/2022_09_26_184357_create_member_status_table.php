<?php

use Database\Seeders\MemberStatusSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class CreateMemberStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_status', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description', 150)->unique('uq_member_status_description');
        });

        (new MemberStatusSeeder())->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_status');
    }
}
