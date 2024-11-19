<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Yaza\LaravelGoogleDriveStorage\Gdrive;
use App\Models\Picture;

class RetrieveFileController extends Controller
{
    /**
     * Handle the incoming request and return all images from Google Drive.
     */
    public function __invoke(Request $request): JsonResponse
    {
        try {
            // Step 1: Retrieve all image file paths from the database (Picture model)
            $pictures = Picture::all();  // Get all pictures from the database

            if ($pictures->isEmpty()) {
                return response()->json(['message' => 'No images found.'], 404);
            }

            // Step 2: Prepare an array to hold the image content (or metadata) from Google Drive
            $images = [];

            // Step 3: Loop through each image and fetch from Google Drive
            foreach ($pictures as $picture) {
                // Assume the file name is stored in the 'image_url' column
                $filePath = $picture->image_url;  // Prefix with "photobooth/" folder name

                // Use Gdrive::get to retrieve the image data from Google Drive
                $image = Gdrive::get($filePath);  // Fetch image content

                // Log the retrieved data structure to see its contents (optional, for debugging)
                Log::info('File Content Retrieved:', ['content' => substr($image->file, 0, 100)]); // Log first 100 bytes for inspection
                Log::info('Mime Type:', ['mime' => $image->ext]);  // Log mime type

                // Push image data into the images array
                $images[] = [
                    'file_name' => $picture->image_url,  // File name from database (image URL)
                    'content' => base64_encode($image->file),  // Base64 encoding for returning image content in JSON
                    'mime_type' => $image->ext,  // Mime type (e.g., 'image/jpeg')
                ];
            }

            // Step 4: Return all images as a JSON response
            return response()->json([
                'images' => $images
            ], 200);

        } catch (\Exception $e) {
            // Handle errors (e.g., Google Drive API issues)
            Log::error('Image retrieval failed', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Failed to retrieve images.'], 500);
        }
    }
}
