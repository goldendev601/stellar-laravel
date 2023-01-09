<?php

namespace Database\Seeders;

use App\ModelsExtended\MemberStatus;
use Illuminate\Database\Seeder;

class MemberStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       self::createOrUpdate();
    }

    public static function createOrUpdate()
    {
        MemberStatus::upsert(
            [
                [ "id" => MemberStatus::Active, "description" => "Active" ],
                [ "id" => MemberStatus::Archived, "description" => "Archived" ],
                [ "id" => MemberStatus::Waitlist, "description" => "Wait list" ],
            ],
            [
                "id"
            ]
        );
    }
}
