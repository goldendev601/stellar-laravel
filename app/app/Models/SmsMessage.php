<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SmsMessage
 * 
 * @property int $id
 * @property string $message_bird_id
 * @property string $sender_msisdn
 * @property string $receiver_msisdn
 * @property string $body
 * @property string $status
 * @property string|null $status_reason
 * @property string|null $recipient_country
 * @property string|null $recipient_operator
 * @property float|null $price_amount
 * @property string|null $price_currency
 * @property Carbon $status_date_time
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class SmsMessage extends Model
{
	protected $table = 'sms_message';

	protected $casts = [
		'price_amount' => 'float'
	];

	protected $dates = [
		'status_date_time'
	];

	protected $fillable = [
		'message_bird_id',
		'sender_msisdn',
		'receiver_msisdn',
		'body',
		'status',
		'status_reason',
		'recipient_country',
		'recipient_operator',
		'price_amount',
		'price_currency',
		'status_date_time'
	];
}
