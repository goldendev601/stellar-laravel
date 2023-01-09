<?php

namespace Database\Seeders;

use App\ModelsExtended\Timezone;
use Illuminate\Database\Seeder;

class TimezoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $filename = public_path('assets/timezones.csv');
        $timezones = self::importCsv($filename);
        self::createOrUpdate($timezones);
    }

    public static function createOrUpdate($timezones)
    {
        foreach ($timezones as $key => $timezone) {
            Timezone::updateOrCreate(
                [
                    "description" => $timezone['offset_tzab']
                ],
                [
                    "offset_gmt" => $timezone['offset_gmt']
                ]
            );
        }
    }

    public static function importCsv($filename, $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;
        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $data;
    }
}
