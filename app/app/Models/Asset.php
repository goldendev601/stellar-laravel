<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Asset
 * 
 * @property int $id
 * @property int $created_by_id
 * @property int $asset_category_id
 * @property int $asset_status_id
 * @property int|null $seller_id
 * @property string|null $name
 * @property string|null $venue_name
 * @property string|null $venue_address
 * @property Carbon $check_in_datetime
 * @property Carbon|null $check_out_date
 * @property Carbon $deadline_datetime
 * @property int $timezone_id
 * @property string|null $description
 * @property string|null $notes
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $unique_id
 * @property string|null $bitly_id
 * 
 * @property AssetStatus $asset_status
 * @property Member|null $member
 * @property Timezone $timezone
 * @property User $user
 * @property AssetCategory $asset_category
 * @property AssetAccommodationInfo $asset_accommodation_info
 * @property AssetCost $asset_cost
 * @property AssetDiningInfo $asset_dining_info
 * @property AssetEventInfo $asset_event_info
 * @property Collection|AssetImage[] $asset_images
 * @property AssetMiscellaneousInfo $asset_miscellaneous_info
 * @property Collection|AssetReceiver[] $asset_receivers
 * @property Collection|AssetTag[] $asset_tags
 *
 * @package App\Models
 */
class Asset extends Model
{
	protected $table = 'asset';

	protected $casts = [
		'created_by_id' => 'int',
		'asset_category_id' => 'int',
		'asset_status_id' => 'int',
		'seller_id' => 'int',
		'timezone_id' => 'int'
	];

	protected $dates = [
		'check_in_datetime',
		'check_out_date',
		'deadline_datetime'
	];

	protected $fillable = [
		'created_by_id',
		'asset_category_id',
		'asset_status_id',
		'seller_id',
		'name',
		'venue_name',
		'venue_address',
		'check_in_datetime',
		'check_out_date',
		'deadline_datetime',
		'timezone_id',
		'description',
		'notes',
		'unique_id',
		'bitly_id'
	];

	public function asset_status()
	{
		return $this->belongsTo(AssetStatus::class);
	}

	public function member()
	{
		return $this->belongsTo(Member::class, 'seller_id');
	}

	public function timezone()
	{
		return $this->belongsTo(Timezone::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'created_by_id');
	}

	public function asset_category()
	{
		return $this->belongsTo(AssetCategory::class);
	}

	public function asset_accommodation_info()
	{
		return $this->hasOne(AssetAccommodationInfo::class);
	}

	public function asset_cost()
	{
		return $this->hasOne(AssetCost::class);
	}

	public function asset_dining_info()
	{
		return $this->hasOne(AssetDiningInfo::class);
	}

	public function asset_event_info()
	{
		return $this->hasOne(AssetEventInfo::class);
	}

	public function asset_images()
	{
		return $this->hasMany(AssetImage::class);
	}

	public function asset_miscellaneous_info()
	{
		return $this->hasOne(AssetMiscellaneousInfo::class);
	}

	public function asset_receivers()
	{
		return $this->hasMany(AssetReceiver::class);
	}

	public function asset_tags()
	{
		return $this->hasMany(AssetTag::class);
	}
}
