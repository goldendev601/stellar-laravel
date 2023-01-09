<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AssetCategory
 * 
 * @property int $id
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Collection|Asset[] $assets
 * @property Collection|Vendor[] $vendors
 *
 * @package App\Models
 */
class AssetCategory extends Model
{
	protected $table = 'asset_category';

	protected $fillable = [
		'description'
	];

	public function assets()
	{
		return $this->hasMany(Asset::class);
	}

	public function vendors()
	{
		return $this->hasMany(Vendor::class);
	}
}
