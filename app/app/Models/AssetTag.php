<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AssetTag
 * 
 * @property int $id
 * @property int $asset_id
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Asset $asset
 *
 * @package App\Models
 */
class AssetTag extends Model
{
	protected $table = 'asset_tag';

	protected $casts = [
		'asset_id' => 'int'
	];

	protected $fillable = [
		'asset_id',
		'description'
	];

	public function asset()
	{
		return $this->belongsTo(Asset::class);
	}
}
