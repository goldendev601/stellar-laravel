<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AssetStatus
 * 
 * @property int $id
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Collection|Asset[] $assets
 *
 * @package App\Models
 */
class AssetStatus extends Model
{
	protected $table = 'asset_status';

	protected $fillable = [
		'description'
	];

	public function assets()
	{
		return $this->hasMany(Asset::class);
	}
}
