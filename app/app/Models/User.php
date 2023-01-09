<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * 
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $role_id
 * @property int $status_id
 * 
 * @property Role $role
 * @property AccountStatus $account_status
 * @property Collection|Asset[] $assets
 *
 * @package App\Models
 */
class User extends Model
{
	protected $table = 'users';

	protected $casts = [
		'role_id' => 'int',
		'status_id' => 'int'
	];

	protected $dates = [
		'email_verified_at'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'first_name',
		'last_name',
		'name',
		'email',
		'email_verified_at',
		'password',
		'remember_token',
		'role_id',
		'status_id'
	];

	public function role()
	{
		return $this->belongsTo(Role::class);
	}

	public function account_status()
	{
		return $this->belongsTo(AccountStatus::class, 'status_id');
	}

	public function assets()
	{
		return $this->hasMany(Asset::class, 'created_by_id');
	}
}
