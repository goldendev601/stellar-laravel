<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ContactGroup
 * 
 * @property int $id
 * @property string $name
 * @property string|null $message_bird_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Collection|MemberGroup[] $member_groups
 *
 * @package App\Models
 */
class ContactGroup extends Model
{
	protected $table = 'contact_group';

	protected $fillable = [
		'name',
		'message_bird_id'
	];

	public function member_groups()
	{
		return $this->hasMany(MemberGroup::class);
	}
}
