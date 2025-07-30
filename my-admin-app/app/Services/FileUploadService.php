<?php

namespace App\Services;

use Exception;


use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;


class FileUploadService
{

    /**
     * Get file name
     *
     * @param string $type
     * @return string
     */
    private $imagemanager;
    public function __construct()
    {
        $this->imagemanager = new ImageManager(new Driver());
    }
    private function getFileName($extension)
    {
        return time() . random_int(1000, 9999) . "." . $extension;
    }


    /**
     * Save and crop event image file
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Modelobject  $table
     * @param string Constant Parameter for (Like: Product, Product Category)  $type 
     * @param string $fileName Old File name     
     * @return bool
     */
    public function saveFiles($request, $table, $type, array $fileFields = [], array $oldFiles = [])
    {
        $config = config("constant.$type");

        if (!$config) {
            throw new \Exception("Missing configuration for type: {$type}");
        }

        $thumbWidth = $config['thumb_width'];
        $thumbHeight = $config['thumb_height'];
        $largeWidth = $config['width'];
        $largeHeight = $config['height'];
        $filePath = rtrim($config['path'] ?? "uploads/$type/", '/') . '/';
        $disk = $config['disk'] ?? 'public';

        // Ensure directories exist
        if (!Storage::disk($disk)->exists($filePath)) {
            Storage::disk($disk)->makeDirectory($filePath, 0775, true);
        }
        if (!Storage::disk($disk)->exists($filePath . "thumb")) {
            Storage::disk($disk)->makeDirectory($filePath . "thumb", 0775, true);
        }

        $savedFiles = [];

        foreach ($fileFields as $inputName => $dbColumn) {

            if ($request->hasFile($inputName)) {
                $extension = $request->file($inputName)->getClientOriginalExtension();
                $fileName = $this->getFileName($extension);
                $file = $request->file($inputName)->storeAs($filePath, $fileName, $disk);

                if ($file && Storage::disk($disk)->exists($file)) {
                    $thumbPath = $filePath . "thumb/" . $fileName;

                    $this->resizeImage(
                        Storage::disk($disk)->path($file),
                        Storage::disk($disk)->path($thumbPath),
                        $thumbWidth,
                        $thumbHeight
                    );

                    $this->resizeImage(
                        Storage::disk($disk)->path($file),
                        Storage::disk($disk)->path($file),
                        $largeWidth,
                        $largeHeight
                    );

                    $table->update([$dbColumn => $fileName]);

                    if (!empty($oldFiles[$inputName])) {
                        $oldThumb = $filePath . "thumb/" . $oldFiles[$inputName];
                        $oldFile = $filePath . $oldFiles[$inputName];

                        if (Storage::disk($disk)->exists($oldFile)) {
                            Storage::disk($disk)->delete($oldFile);
                        }
                        if (Storage::disk($disk)->exists($oldThumb)) {
                            Storage::disk($disk)->delete($oldThumb);
                        }
                    }

                    $savedFiles[$inputName] = $fileName;
                }
            }
        }
       // dd($savedFiles);

        return !empty($savedFiles);
    }





    /**
     * Delete  image file
     *
     * @param string $type Constant Parameter for (Like: Product, Product Category)
     * @param string $fileName  File name     
     * @return bool
     */
    public function deleteFiles($type, $fileName)
    {
        $config = config("constant.$type");

        if (!$config) {
            throw new \Exception("Missing configuration for type: {$type}");
        }

        $filePath = rtrim($config['path'] ?? "uploads/$type/", '/') . '/';
        $disk = $config['disk'] ?? 'public';

        $mainFile = $filePath . $fileName;
        $thumbFile = $filePath . 'thumb/' . $fileName;

        $deleted = false;

        if (Storage::disk($disk)->exists($mainFile)) {
            Storage::disk($disk)->delete($mainFile);
            $deleted = true;
        }

        if (Storage::disk($disk)->exists($thumbFile)) {
            Storage::disk($disk)->delete($thumbFile);
            $deleted = true;
        }

        return $deleted;
    }



    /**
     * Generate and save avatar image
     *
     * @param string $name
     * @param string|null $filename
     * @param int $size
     * @return string Path to the saved avatar image
     */

    public function generateAndSave(string $name, string $filename = null, int $size = 128): string
    {

        $initials = $this->getInitials($name);
        $background = $this->getColorFromName($name);

        // Create blank image
        //$image = $this->imagemanager->create($size, $size, $background);
        $circle = $this->imagemanager->create($size, $size)->fill('rgba(0,0,0,0)');

        $center = $size / 2;
        $radius = $center;

        ////With the Border
        $borderColor = $background;
        $borderWidth = 2;
        $centerX = $centerY = $size / 2;


        for ($y = 0; $y < $size; $y++) {
            for ($x = 0; $x < $size; $x++) {
                $dx = $x - $centerX;
                $dy = $y - $centerY;
                $distance = sqrt($dx * $dx + $dy * $dy);

                if ($distance <= $radius) {
                    // Border region
                    if ($distance >= $radius - $borderWidth) {
                        $circle->drawPixel($x, $y, $borderColor);
                    } else {
                        $circle->drawPixel($x, $y, $background);
                    }
                }
            }
        }
        ////Without the border, you can use the following code:

        // for ($y = 0; $y < $size; $y++) {
        //     for ($x = 0; $x < $size; $x++) {
        //         $dx = $x - $center;
        //         $dy = $y - $center;

        //         if (($dx * $dx + $dy * $dy) <= ($radius * $radius)) {
        //             $circle->drawPixel($x, $y, $background);
        //         }

        //     }
        // }

        // Add initials text
        $circle->text($initials, $center, $center, function ($font) use ($size) {
            $font->filename(public_path('backend/fonts/static/Roboto-Regular.ttf'));
            $font->size($size / 2.5);
            // $font->size(50);
            $font->color('#ffffffff');
            $font->align('center');
            $font->valign('middle');
        });

        $filename = $filename ?: Str::slug($name) . '-' . time() . '.webp';
        $filename = "{$filename}";

        Storage::disk('avatars')->put($filename, (string) $circle->encode(new WebpEncoder()));

        return $filename;
    }

    private function getInitials(string $name, int $maxLetters = 3): string
    {
        $parts = preg_split('/\s+/', trim($name));
        $initials = '';

        foreach ($parts as $part) {
            if (strlen($initials) >= $maxLetters) {
                break;
            }
            $initials .= substr($part, 0, 1);
        }

        return strtoupper($initials);
    }


    private function getColorFromName(string $name): string
    {
        return '#' . substr(md5($name), 0, 6); // consistent color
    }

    /**
     * Crop the image
     *
     * @param string $sourcePath
     * @param string $destinationPath
     * @param int $width
     * @param int $height
     * @return bool
     */
    private function resizeImage($sourcePath, $destinationPath, $width = 375, $height = 680)
    {
        try {
            $ratio = config('constants.maintain_crop_ratio');
            if (file_exists($sourcePath)) {
                $img = $this->imagemanager->read($sourcePath);
                if ($ratio) {
                    $chatObj = $img->resize($width, $height, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })->save($destinationPath);
                } else {
                    $chatObj = $img->resize($width, $height)->save($destinationPath);
                }
            } else {
                return false;
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        return true;
    }
}
