<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AccountStatus
 * 
 * @property int $id
 * @property string $description
 * 
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class AccountStatus extends Model
{
	protected $table = 'account_status';
	public $timestamps = false;

	protected $fillable = [
		'description'
	];

	public function users()
	{
		return $this->hasMany(User::class, 'status_id');
	}
}
