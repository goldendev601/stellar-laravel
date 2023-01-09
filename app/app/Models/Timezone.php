<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Timezone
 * 
 * @property int $id
 * @property string $description
 * @property string $offset_gmt
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Collection|Asset[] $assets
 * @property Collection|Vendor[] $vendors
 *
 * @package App\Models
 */
class Timezone extends Model
{
	protected $table = 'timezone';

	protected $fillable = [
		'description',
		'offset_gmt'
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
