<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AssetMiscellaneousInfo
 * 
 * @property int $id
 * @property int $asset_id
 * @property string|null $display_date
 * @property string|null $event_name
 * @property string|null $event_type
 * @property string|null $ticket_holder
 * @property int|null $number_of_seats
 * @property string|null $seat_area
 * @property string|null $multiple_locations
 * @property string|null $total_paid
 * @property string|null $venue_layout
 * @property string|null $cancellation_policy
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Asset $asset
 *
 * @package App\Models
 */
class AssetMiscellaneousInfo extends Model
{
	protected $table = 'asset_miscellaneous_info';

	protected $casts = [
		'asset_id' => 'int',
		'number_of_seats' => 'int'
	];

	protected $fillable = [
		'asset_id',
		'display_date',
		'event_name',
		'event_type',
		'ticket_holder',
		'number_of_seats',
		'seat_area',
		'multiple_locations',
		'total_paid',
		'venue_layout',
		'cancellation_policy'
	];

	public function asset()
	{
		return $this->belongsTo(Asset::class);
	}
}
