<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AssetReceiver
 * 
 * @property int $id
 * @property int $asset_id
 * @property int $member_id
 * @property string $message
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $message_bird_id
 * @property string $msisdn
 * @property string $status
 * 
 * @property Asset $asset
 * @property Member $member
 *
 * @package App\Models
 */
class AssetReceiver extends Model
{
	protected $table = 'asset_receiver';

	protected $casts = [
		'asset_id' => 'int',
		'member_id' => 'int'
	];

	protected $fillable = [
		'asset_id',
		'member_id',
		'message',
		'message_bird_id',
		'msisdn',
		'status'
	];

	public function asset()
	{
		return $this->belongsTo(Asset::class);
	}

	public function member()
	{
		return $this->belongsTo(Member::class);
	}
}
