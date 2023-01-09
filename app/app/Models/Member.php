<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Member
 * 
 * @property int $id
 * @property string $first_name
 * @property string|null $last_name
 * @property string|null $email
 * @property string $msisdn
 * @property string|null $message_bird_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string|null $image_relative_url
 * @property string|null $zipcode
 * @property int $member_status_id
 * 
 * @property MemberStatus $member_status
 * @property Collection|Asset[] $assets
 * @property Collection|AssetReceiver[] $asset_receivers
 * @property Collection|MemberGroup[] $member_groups
 * @property Collection|MemberInterest[] $member_interests
 *
 * @package App\Models
 */
class Member extends Model
{
	protected $table = 'member';

	protected $casts = [
		'member_status_id' => 'int'
	];

	protected $fillable = [
		'first_name',
		'last_name',
		'email',
		'msisdn',
		'message_bird_id',
		'image_relative_url',
		'zipcode',
		'member_status_id'
	];

	public function member_status()
	{
		return $this->belongsTo(MemberStatus::class);
	}

	public function assets()
	{
		return $this->hasMany(Asset::class, 'seller_id');
	}

	public function asset_receivers()
	{
		return $this->hasMany(AssetReceiver::class);
	}

	public function member_groups()
	{
		return $this->hasMany(MemberGroup::class);
	}

	public function member_interests()
	{
		return $this->hasMany(MemberInterest::class);
	}
}
