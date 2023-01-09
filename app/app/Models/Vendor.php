<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Vendor
 * 
 * @property int $id
 * @property string $name
 * @property string|null $alias
 * @property string|null $city
 * @property int $timezone_id
 * @property string|null $neighborhood
 * @property string|null $type
 * @property string|null $website
 * @property string|null $description
 * @property string|null $address
 * @property string|null $tags
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $asset_category_id
 * @property string|null $phone
 * @property string|null $email
 * 
 * @property AssetCategory $asset_category
 * @property Timezone $timezone
 * @property Collection|VendorImage[] $vendor_images
 *
 * @package App\Models
 */
class Vendor extends Model
{
	protected $table = 'vendor';

	protected $casts = [
		'timezone_id' => 'int',
		'asset_category_id' => 'int'
	];

	protected $fillable = [
		'name',
		'alias',
		'city',
		'timezone_id',
		'neighborhood',
		'type',
		'website',
		'description',
		'address',
		'tags',
		'asset_category_id',
		'phone',
		'email'
	];

	public function asset_category()
	{
		return $this->belongsTo(AssetCategory::class);
	}

	public function timezone()
	{
		return $this->belongsTo(Timezone::class);
	}

	public function vendor_images()
	{
		return $this->hasMany(VendorImage::class);
	}
}
