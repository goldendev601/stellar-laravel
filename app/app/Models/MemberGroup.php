<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MemberGroup
 * 
 * @property int $id
 * @property int $member_id
 * @property int $contact_group_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property ContactGroup $contact_group
 * @property Member $member
 *
 * @package App\Models
 */
class MemberGroup extends Model
{
	protected $table = 'member_group';

	protected $casts = [
		'member_id' => 'int',
		'contact_group_id' => 'int'
	];

	protected $fillable = [
		'member_id',
		'contact_group_id'
	];

	public function contact_group()
	{
		return $this->belongsTo(ContactGroup::class);
	}

	public function member()
	{
		return $this->belongsTo(Member::class);
	}
}
