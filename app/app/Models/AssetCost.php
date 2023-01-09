<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AssetCost
 * 
 * @property int $id
 * @property int $asset_id
 * @property int $currency_type_id
 * @property float $amount
 * @property float $usd_amount
 * @property string|null $cost_details
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Asset $asset
 * @property CurrencyType $currency_type
 *
 * @package App\Models
 */
class AssetCost extends Model
{
	protected $table = 'asset_cost';

	protected $casts = [
		'asset_id' => 'int',
		'currency_type_id' => 'int',
		'amount' => 'float',
		'usd_amount' => 'float'
	];

	protected $fillable = [
		'asset_id',
		'currency_type_id',
		'amount',
		'usd_amount',
		'cost_details'
	];

	public function asset()
	{
		return $this->belongsTo(Asset::class);
	}

	public function currency_type()
	{
		return $this->belongsTo(CurrencyType::class);
	}
}
