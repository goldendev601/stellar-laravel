<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AssetDiningInfo
 * 
 * @property int $id
 * @property int $asset_id
 * @property string|null $guest_name
 * @property int|null $number_of_guest
 * @property string|null $guest_email
 * @property string|null $guest_phone
 * @property string|null $menu_highlights
 * @property string|null $venue_phone
 * @property string|null $cancellation_policy
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Asset $asset
 *
 * @package App\Models
 */
class AssetDiningInfo extends Model
{
	protected $table = 'asset_dining_info';

	protected $casts = [
		'asset_id' => 'int',
		'number_of_guest' => 'int'
	];

	protected $fillable = [
		'asset_id',
		'guest_name',
		'number_of_guest',
		'guest_email',
		'guest_phone',
		'menu_highlights',
		'venue_phone',
		'cancellation_policy'
	];

	public function asset()
	{
		return $this->belongsTo(Asset::class);
	}
}
