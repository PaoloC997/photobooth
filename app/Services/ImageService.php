<?php

namespace App\Services;

use Intervention\Image\ImageManager; // Import ImageManager
use Intervention\Image\Drivers\Gd\Driver as GdDriver; // Import GD driver
use Illuminate\Support\Str; // For unique naming

class ImageService
{
    public function compressAndSave($file)
    {
        // Initialize ImageManager with the GD driver
        $manager = new ImageManager(new GdDriver());

        // Generate a unique name for the image
        $uniqueName = Str::uuid() . '.webp';

        // Read the uploaded image file
        $image = $manager->read($file);

        // Set the path to save the image in the public/images directory
        $path = "images/{$uniqueName}";

        // Save the image to the public/images folder (using public_path)
        $image->save(public_path($path), 80, 'webp'); // Quality set to 80

        // Return the path to store in the database
        return $path;
    }
}
