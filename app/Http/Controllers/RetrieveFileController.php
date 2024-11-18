<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class RetrieveFileController extends Controller
{
    /**
     * Handle the incoming request and return the image.
     */
    public function __invoke(Request $request, $filePath): Response
    {
        try {
            
            $image = Gdrive::get($filePath);  // This should return file content and mime type
                   // Log the file data and mime type to verify
            Log::info('File Content Retrieved:', ['content' => substr($image->file, 0, 100)]); // Log first 100 bytes for inspection
            Log::info('Mime Type:', ['mime' => $image->ext]);

            // Step 2: Return the image as response with the correct content type
            return response($image->file, 200)
                ->header('Content-Type', $image->ext);  // 'image/jpeg', 'image/png', etc.
        } catch (\Exception $e) {
            // Handle errors (e.g., file not found, API issues, etc.)
            Log::error('Image retrieval failed', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Failed to retrieve image.'], 500);
        }
    }
}
