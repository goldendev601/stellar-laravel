<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AssetImage
 * 
 * @property int $id
 * @property int $asset_id
 * @property string $image_relative_url
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Asset $asset
 *
 * @package App\Models
 */
class AssetImage extends Model
{
	protected $table = 'asset_image';

	protected $casts = [
		'asset_id' => 'int'
	];

	protected $fillable = [
		'asset_id',
		'image_relative_url',
		'name'
	];

	public function asset()
	{
		return $this->belongsTo(Asset::class);
	}
}
