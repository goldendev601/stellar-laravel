<?php

namespace App\ModelsExtended;

use App\ModelsExtended\Traits\HasImageUrlSavingModelTrait;

class AssetImage extends \App\Models\AssetImage
{
    use HasImageUrlSavingModelTrait;

    protected $appends = [ 'image_url'];

}