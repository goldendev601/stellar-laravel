<?php

namespace App\ModelsExtended;

use App\ModelsExtended\VendorImage;

class Vendor extends \App\Models\Vendor
{
    public function logo()
    {
        return $this->hasOne(VendorImage::class)->where('type','=','logo');
    }

    public function images()
    {
        return $this->hasMany(VendorImage::class)->where('type','=','photo');
    }
    public function timezone()
    {
        return $this->belongsTo(Timezone::class);
    }
}
