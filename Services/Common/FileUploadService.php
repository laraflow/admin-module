<?php


namespace Modules\Admin\Services\Common;


use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Laravolt\Avatar\Facade as Avatar;

class FileUploadService
{
    /**
     * @param string $name
     * @param string $extension
     * @return string|null
     * @throws Exception
     */
    public function createAvatarImageFromText(string $name, string $extension = 'jpg'): ?string
    {
        $fileName = $this->randomFileName($extension);

        $tmpPath = public_path('/media/tmp/');

        if (!is_dir($tmpPath))
            mkdir($tmpPath, '0777', true);

        $imageObject = Image::canvas(256, 256, '#ffffff');
        try {
            $imageObject = Avatar::create($name)->getImageObject();
        } catch (Exception $imageMakeException) {
            $imageObject = Image::make('public/assets/images/favicon.ico');
            \Log::error($imageMakeException->getMessage());
        } finally {
            try {
                if ($imageObject instanceof \Intervention\Image\Image) {
                    if ($imageObject->resize(256, 256)->save($tmpPath . $fileName, 80, $extension)) {
                        return $tmpPath . $fileName;
                    } else
                        return null;
                }

            } catch (Exception $imageSaveException) {
                \Log::error($imageSaveException->getMessage());
                return null;
            }
        }

        return null;
    }

    /**
     * @param UploadedFile $file
     * @param string $extension
     * @return string|null
     */
    public function createAvatarImageFromInput(UploadedFile $file, string $extension = 'jpg'): ?string
    {
        $fileName = $this->randomFileName($extension);
        $tmpPath = public_path('/media/tmp/');
        $imageObject = Image::canvas(256, 256, '#ffffff');

        try {
            $imageObject = Image::make($file);
        } catch (Exception $imageMakeException) {
            $imageObject = Image::make('public/assets/images/favicon.ico');
            Log::error($imageMakeException->getMessage());
        } finally {
            try {
                if ($imageObject instanceof Image) {
                    if ($imageObject->resize(256, 256, function ($constraint) {
                        $constraint->aspectRatio();
                    })->crop(256, 256, 0, 0)
                        ->circle(255 / 2, 0, 0, function ($draw) {
                            $draw->border(1, '#000000');
                        })
                        ->save($tmpPath . $fileName, 80, $extension))
                        return $tmpPath . $fileName;
                    else
                        return null;
                }

            } catch (Exception $imageSaveException) {
                \Log::error($imageSaveException->getMessage());
                return null;
            }
        }

        return null;
    }

    /**
     * @param string $extension
     * @return string
     */
    public function randomFileName(string $extension = 'jpg'): string
    {
        return Str::random(32) . '.' . $extension;
    }
}