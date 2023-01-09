<?php

namespace App\Observers;

use App\ModelsExtended\Asset;
use Illuminate\Support\Str;

class AssetModelObserver
{
    public function creating( Asset $asset )
    {
        $asset->unique_id = Str::uuid()->toString();
    }
}
