<?php

namespace App\Imports;


use App\ModelsExtended\VendorImage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\ModelsExtended\Vendor;

class VendorImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    use Importable;

    /**
     * @param ToModel $row
     */
    public function model(array $row)
    {
        if ($row['name'] != null && $row['address'] != null  && $row['asset_category_id']) {


            $vendor = Vendor::updateOrCreate(
                [
                    'address' => $row['address']
                ],
                [
                    'name' => $row['name'],
                    'city' => $row['city'],
                    'timezone_id' => $row['timezone_id'] != null ? $row['timezone_id'] : 1,
                    'neighborhood' => $row['neighborhood'],
                    'description' => $row['description'],
                    'asset_category_id' => $row['asset_category_id'],
                ]);
            $vendorImages = [];
            if ($row['photo_url'] != null) {
                if ($imageContents = @file_get_contents($row['photo_url'], 'r')) {
                    $fileName = explode('/', $row['photo_url']);
                    $fileName = end($fileName);
                    if (str_contains($fileName, '?')) {
                        $fileName = explode('?', $fileName);
                        $fileName = $fileName[0];
                    }

                    $path = "vendors/" . Str::slug($row['name']) . '/' . $fileName;
                    Storage::cloud()->put($path, file_get_contents($row['photo_url']));
                    $vendorImages[] = [
                        "vendor_id" => $vendor->id,
                        "image_relative_url" => $path,
                        "type" => "Logo"
                    ];

                    if (count($vendorImages) > 0) {
                        $vendorImageExist = VendorImage::where('vendor_id', $vendor->id)->first();
                        if ($vendorImageExist == null) {
                            VendorImage::insert($vendorImages);
                        }

                    }

                }
            }
        }

    }


    public function chunkSize(): int
    {
        return 10;
    }
}
