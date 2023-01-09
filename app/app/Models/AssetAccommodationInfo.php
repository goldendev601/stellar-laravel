<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AssetAccommodationInfo
 * 
 * @property int $id
 * @property int $asset_id
 * @property string|null $guest_name
 * @property int|null $number_of_guest
 * @property int|null $number_of_night
 * @property string|null $confirmation_number
 * @property string|null $venue_phone
 * @property string|null $cancellation_cost
 * @property string|null $website
 * @property string|null $cancellation_policy
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Asset $asset
 *
 * @package App\Models
 */
class AssetAccommodationInfo extends Model
{
	protected $table = 'asset_accommodation_info';

	protected $casts = [
		'asset_id' => 'int',
		'number_of_guest' => 'int',
		'number_of_night' => 'int'
	];

	protected $fillable = [
		'asset_id',
		'guest_name',
		'number_of_guest',
		'number_of_night',
		'confirmation_number',
		'venue_phone',
		'cancellation_cost',
		'website',
		'cancellation_policy'
	];

	public function asset()
	{
		return $this->belongsTo(Asset::class);
	}
}
