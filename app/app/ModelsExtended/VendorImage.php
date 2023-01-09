<?php

namespace App\ModelsExtended;

use App\ModelsExtended\Traits\HasImageUrlSavingModelTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * @property string $image_url
 */
class VendorImage extends \App\Models\VendorImage
{
    use HasImageUrlSavingModelTrait;

    protected $appends = [ 'image_url','preview_image_aws'];

    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->image_relative_url,
        );
    }

    protected function previewImageAws(): Attribute
    {
        return Attribute::make(
            get: fn () => env('AWS_URL').''.$this->image_relative_url,
        );
    }

}
