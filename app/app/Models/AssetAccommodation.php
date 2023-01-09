<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetAccommodation extends Model
{
    protected $fillable = [
        'asset_id',
        'check_in',
        'check_out',
        'confirmation_number',
        'guest_name',
        'number_of_guests',
        'venue_phone',
        'cancellation_cost',
        'website',
        'cancellation_policy',
        'notes',
    ];

    public function asset()
    {
        return $this->hasOne(Asset::class, 'id', 'asset_id');
    }
}
