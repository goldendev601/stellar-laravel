<?php

namespace Database\Seeders;

use App\ModelsExtended\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::upsert(
           [
               ["id" => Role::Super_Admin, "description" => "Super Admin"],
               ["id" => Role::Administrator, "description" => "Administrator"],
           ], [ "id" ]
        );
    }
}
