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
    public function saveFiles($request, $table, $type, $oldFileName = '')
    {

        $thumbWidth = config("constant." . $type . "_photo_thumb_width");
        $thumbHeight = config("constant." . $type . "_photo_thumb_height");
        $largeWidth = config("constant." . $type . "_photo_large_width");
        $largeHeight = config("constant." . $type . "_photo_large_height");
        $filePath = config("constant." . $type . "_photo_path");

        if (!Storage::exists($filePath)) {
            Storage::makeDirectory($filePath, 0775, true);
        }
        if (!Storage::exists($filePath . "/thumb")) {
            Storage::makeDirectory($filePath . "/thumb", 0775, true);
        }

        if ($request->hasfile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName =  $this->getFileName($extension);
            $file = $request->file('image')->storeAs($filePath, $fileName);
            if (!empty($file) && Storage::exists($file)) {
                $thumbPath = $filePath . "thumb/" . $fileName;

                $this->resizeImage(Storage::path($file), Storage::path($thumbPath), $thumbWidth, $thumbHeight);
                $this->resizeImage(Storage::path($file), Storage::path($file), $largeWidth, $largeHeight);
                $res = $table->update(['image' => $fileName]);

                if ($res && !empty($oldFileName)) {
                    if (Storage::exists($filePath . $oldFileName)) {
                        Storage::delete($filePath . $oldFileName);
                    }
                    if (Storage::exists($filePath . "thumb/" . $oldFileName)) {
                        Storage::delete($filePath . "thumb/" . $oldFileName);
                    }
                }
                //return true;
            }
        }

        if ($request->hasfile('banner') && $type == 'pages') {


            $extension = $request->file('banner')->getClientOriginalExtension();
            $fileName =  $this->getFileName($extension);
            $file = $request->file('banner')->storeAs($filePath, $fileName);

            if (!empty($file) && Storage::exists($file)) {

                // $imageCropService = new ImageCropService();               
                // $imageCropService->resizeImage(Storage::path($file), Storage::path($file), $largeWidth, $largeHeight);
                $res = $table->update(['banner' => $fileName]);
                if ($res && !empty($oldFileName)) {
                    if (Storage::exists($filePath . $oldFileName)) {
                        Storage::delete($filePath . $oldFileName);
                    }
                }

                //return true;
            }
        }

        if ($request->hasfile('watermark')) {

            $extension = $request->file('watermark')->getClientOriginalExtension();
            $fileName =  $this->getFileName($extension);
            $file = $request->file('watermark')->storeAs($filePath, $fileName);

            if (!empty($file) && Storage::exists($file)) {
                $res = $table->update(['watermark' => $fileName]);
                if ($res && !empty($oldFileName)) {
                    if (Storage::exists($filePath . $oldFileName)) {
                        Storage::delete($filePath . $oldFileName);
                    }
                }
            }
        }

        if ($request->hasfile('profile') && $type == 'testimonials') {

            $extension = $request->file('profile')->getClientOriginalExtension();
            $fileName =  $this->getFileName($extension);
            $file = $request->file('profile')->storeAs($filePath, $fileName);
            if (!empty($file) && Storage::exists($file)) {

                $this->resizeImage(Storage::path($file), Storage::path($file), 48, 48);
                $res = $table->update(['profile' => $fileName]);
                if ($res && !empty($oldFileName)) {
                    if (Storage::exists($filePath . $oldFileName)) {
                        Storage::delete($filePath . $oldFileName);
                    }
                }
                //return true;
            }
        }
        if ($request->hasfile('gallery')) {
            $oldFileName = $request->gallery_old;;
            $gallery = [];
            $files = $request->file('gallery');
            $largeWidth = config("constant." . $type . "_gallery_photo_large_width");
            $largeHeight = config("constant." . $type . "_gallery_photo_large_height");
            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $fileName =  $this->getFileName($extension);
                $gallery[] = $fileName;
                $filegallery = $file->storeAs($filePath, $fileName);
                if (!empty($filegallery) && Storage::exists($filegallery)) {
                    $thumbPath = $filePath . "thumb/" . $fileName;

                    $this->resizeImage(Storage::path($filegallery), Storage::path($thumbPath), $thumbWidth, $thumbHeight);
                    $this->resizeImage(Storage::path($filegallery), Storage::path($filegallery), $largeWidth, $largeHeight);

                    if (!empty($oldFileName)) {
                        if (Storage::exists($filePath . $oldFileName)) {
                            Storage::delete($filePath . $oldFileName);
                        }
                        if (Storage::exists($filePath . "thumb/" . $oldFileName)) {
                            Storage::delete($filePath . "thumb/" . $oldFileName);
                        }
                    }
                }
            }
            $res = $table->update(['gallery' => implode(',', $gallery)]);
        }

        if ($request->hasfile('banner') || $request->hasfile('image') || $request->hasfile('gallery') || $request->hasfile('profile')) {
            return true;
        }
        return false;
    }

    /**
     * Delete  image file
     *
     * @param string $type Constant Parameter for (Like: Product, Product Category)
     * @param string $fileName  File name     
     * @return bool
     */
    public function delteFiles($type, $fileName)
    {
        $filePath = config("constant." . $type . "_photo_path");

        if (Storage::exists($filePath . $fileName) || Storage::exists($filePath . "thumb/" . $fileName)) {
            Storage::delete($filePath . $fileName);
            Storage::delete($filePath . "thumb/" . $fileName);
            return true;
        }
        return false;
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
            $ratio = config('constants.maintain_photo_crop_ratio');
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
