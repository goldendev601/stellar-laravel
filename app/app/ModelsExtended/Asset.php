<?php

namespace App\ModelsExtended;

use App\ModelsExtended\Interfaces\IHasFolderStoragePathModelInterface;
use App\Repositories\Bitly\ApiRequests;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @property string $public_url
 * @property Collection|AssetImage[] $asset_images
 */
class Asset extends \App\Models\Asset  implements IHasFolderStoragePathModelInterface
{
    protected $appends = [ "public_url" ];

    /**
     * %s = > UUID
     */
    public const PUBLIC_VIEW_PATH = "share/assets/%s";

    /**
     * @param string $uuid
     * @return Builder|Model|object|null|Asset
     */
    public function getByUUID(string $uuid): Model|Asset|Builder|null
    {
        return self::query()->where('unique_id', $uuid)->first();
    }

    /**
     * @param string $id
     * @return Builder|Model|object|null|Asset
     */
    public static function getByID(string $id): Model|Asset|Builder|null
    {
        return self::query()->where('id', $id)->first();
    }

    /**
     * @return Attribute
     */
    public function publicUrl():Attribute
    {
        return Attribute::get(fn() => url(sprintf(self::PUBLIC_VIEW_PATH, $this->unique_id )));
    }

    public function asset_images()
    {
        return $this->hasMany(AssetImage::class);
    }

    public function getFolderStorageRelativePath(): string
    {
        return "assets/{$this->id}";
    }

    public static function format_date($value)
	{
		return Carbon::parse($value)->format('Y-m-d');;
	}

	public static function format_date_time($date,$time)
	{
		return Carbon::parse($date.' '.$time)->format('Y-m-d H:m:s');
	}

    public static function format_date_frontend($date)
    {
        return Carbon::parse($date)->format('Y-m-d h:i:A');
    }

    /**
     * @return string
     * @throws \App\Exceptions\APIInvocationException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getShareableMessageSample(): string
    {

        if( isAppInDebugMode() )
            return sprintf("Hi! Found some %s that I thought you might want to check out @ https://%s",
                Str::title($this->asset_category->description),
                "http://aliraza-testing-in-debug.com"
            );

        return sprintf("Hi! Found some %s that I thought you might want to check out @ https://%s",
            Str::title($this->asset_category->description),
            $this->createOrGetShortenedUrl()
        );
    }

    /**
     * @return string
     * @throws \App\Exceptions\APIInvocationException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function createOrGetShortenedUrl(): string
    {
        if( $this->bitly_id ) return $this->bitly_id;

        $request = new ApiRequests();
        $this->bitly_id = $request->shortenUrl($this->public_url )->getData()->id;
        $this->updateQuietly();

        return  $this->bitly_id;
    }

    public function assetCategory()
    {
        return $this->belongsTo(AssetCategory::class);
    }
}
