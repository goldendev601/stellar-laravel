<?php

use App\ModelsExtended\Role;
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
        \Database\Seeders\AccountStatusSeeder::createOrUpdate();
        (new \Database\Seeders\RoleSeeder())->run();

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->nullable(false)->index('fk_users_role_id')->default(Role::Administrator);
            $table->unsignedBigInteger('status_id')->nullable(false)->index('fk_users_status_id')->default(\App\ModelsExtended\AccountStatus::APPROVED);

            $table->foreign(['role_id'], 'fk_users_role_id')->references(['id'])->on('roles')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['status_id'], 'fk_users_status_id')->references(['id'])->on('account_status')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('fk_users_status_id');
            $table->dropForeign('fk_users_role_id');

            $table->dropIndex('fk_users_status_id');
            $table->dropColumn('status_id');

            $table->dropIndex('fk_users_role_id');
            $table->dropColumn('role_id');
        });
    }
};
