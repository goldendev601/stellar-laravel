<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MemberInterest
 * 
 * @property int $id
 * @property int $member_id
 * @property string $interest
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Member $member
 *
 * @package App\Models
 */
class MemberInterest extends Model
{
	protected $table = 'member_interest';

	protected $casts = [
		'member_id' => 'int'
	];

	protected $fillable = [
		'member_id',
		'interest'
	];

	public function member()
	{
		return $this->belongsTo(Member::class);
	}
}
