<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MemberStatus
 * 
 * @property int $id
 * @property string $description
 * 
 * @property Collection|Member[] $members
 *
 * @package App\Models
 */
class MemberStatus extends Model
{
	protected $table = 'member_status';
	public $timestamps = false;

	protected $fillable = [
		'description'
	];

	public function members()
	{
		return $this->hasMany(Member::class);
	}
}
