<?php

namespace Database\Seeders;

use App\ModelsExtended\AssetCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AssetCategorySeeder extends Seeder
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
        AssetCategory::upsert(
            [
                [ "id" => AssetCategory::Accommodation, "description" => "Accommodation" ],
                [ "id" => AssetCategory::Dining, "description" => "Dining" ],
                [ "id" => AssetCategory::Event, "description" => "Event" ],
                [ "id" => AssetCategory::Miscellaneous, "description" => "Miscellaneous" ],
            ],
            [
                "name"
            ]
        );
    }
}
