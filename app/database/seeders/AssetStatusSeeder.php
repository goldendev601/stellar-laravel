<?php

namespace Database\Seeders;

use App\ModelsExtended\AssetStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AssetStatusSeeder extends Seeder
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
        AssetStatus::upsert(
            [
                [ "id" => AssetStatus::Available, "description" => "Available" ],
                [ "id" => AssetStatus::Sold, "description" => "Sold" ],
                [ "id" => AssetStatus::Expired, "description" => "Expired" ],
            ],
            [
                "name"
            ]
        );
    }
}
