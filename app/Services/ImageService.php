<?php

namespace App\Services;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver; 
use Illuminate\Support\Str;

class ImageService
{
    public function compressAndSave($file)
    {
        $manager = new ImageManager(new GdDriver());
        $uniqueName = Str::uuid() . '.webp';

        $image = $manager->read($file);

        $path = "images/{$uniqueName}";

        $image->save(public_path($path), 80, 'webp'); 

        return $path;
    }
}
