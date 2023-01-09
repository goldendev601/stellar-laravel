<?php

namespace App\ModelsExtended\Traits;

use App\ModelsExtended\Interfaces\IHasFolderStoragePathModelInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * Indicate that this model can save relative image url.
 * @property string|null $image_url
 */
trait HasImageUrlSavingModelTrait
{
    public function getImageUrlAttribute(): ?string
    {
        return $this->image_relative_url ? Storage::cloud()->url($this->image_relative_url) : null;
    }

    /**
     * Get traceable file name
     *
     * @param UploadedFile $file
     * @param IHasFolderStoragePathModelInterface $modelBase
     * @param string $containerName
     * @return string
     */
    public static function generateImageRelativePath(UploadedFile $file, IHasFolderStoragePathModelInterface $modelBase, string $containerName = "pictures"): string
    {
        return self::generateImageRelativePathWithFileName($file->hashName(), $modelBase, $containerName);
    }

    /**
     * Get traceable file name
     *
     * @param string $fileName
     * @param IHasFolderStoragePathModelInterface $modelBase
     * @param string $containerName
     * @return string
     */
    public static function generateImageRelativePathWithFileName(string $fileName, IHasFolderStoragePathModelInterface $modelBase, string $containerName = "pictures"): string
    {
        return sprintf("%s/%s/%s", $modelBase->getFolderStorageRelativePath(), $containerName, $fileName);
    }

    //    /**
//     * @param UploadedFile|null $file
//     * @return string|null
//     */
//    public function saveImageOnCloud(?UploadedFile $file): ?string
//    {
//        if( !$file ) return null;
//        $file_path=time().str_replace(" ","",$file->getClientOriginalName());
//        Storage::disk('s3')->put( $file_path, $file->getContent() );
//        return $file_path;
//    }

    /**
     * @param UploadedFile $file
     * @param IHasFolderStoragePathModelInterface $modelBase
     * @return string
     */
    public static function saveImageOnCloud(UploadedFile $file, IHasFolderStoragePathModelInterface $modelBase): string
    {
        $image_relative_url = self::generateImageRelativePath($file, $modelBase);
        Storage::cloud()->put($image_relative_url, $file->getContent());
        return $image_relative_url;
    }
    public static function saveImageOnCloudWithUrl($fileName, IHasFolderStoragePathModelInterface $modelBase, $contents): string
    {
        $image_relative_url = self::generateImageRelativePathWithFileName($fileName, $modelBase);
        Storage::cloud()->put($image_relative_url, $contents);
        return $image_relative_url;
    }
}
