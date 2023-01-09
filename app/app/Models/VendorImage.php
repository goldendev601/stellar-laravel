<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VendorImage
 * 
 * @property int $id
 * @property int $vendor_id
 * @property string $image_relative_url
 * @property string $type
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Vendor $vendor
 *
 * @package App\Models
 */
class VendorImage extends Model
{
	protected $table = 'vendor_images';

	protected $casts = [
		'vendor_id' => 'int'
	];

	protected $fillable = [
		'vendor_id',
		'image_relative_url',
		'type'
	];

	public function vendor()
	{
		return $this->belongsTo(Vendor::class);
	}
}
