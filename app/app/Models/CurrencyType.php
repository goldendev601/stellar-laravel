<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CurrencyType
 * 
 * @property int $id
 * @property string $description
 * 
 * @property Collection|AssetCost[] $asset_costs
 *
 * @package App\Models
 */
class CurrencyType extends Model
{
	protected $table = 'currency_type';
	public $timestamps = false;

	protected $fillable = [
		'description'
	];

	public function asset_costs()
	{
		return $this->hasMany(AssetCost::class);
	}
}
