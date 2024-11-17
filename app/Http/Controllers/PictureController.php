<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Picture;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class PictureController extends Controller
{
    /**
     * Handle the incoming request and upload the image to Google Drive.
     */
    public function store(Request $request)
    {

      
        $validated = $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',  
        ]);

     
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '-' . $file->getClientOriginalName(); 

           
            try {
               
                $folderPath = env('GOOGLE_DRIVE_FOLDER_ID'); 
                $fileUrl = Gdrive::put("{$folderPath}/{$fileName}", $file);

                $image = new Picture();
                $image->image_url = $fileUrl;
                $image->save();

                return response()->json([
                    'message' => 'Image uploaded successfully!',
                    'image_url' => $fileUrl,
                ], 200);
            } catch (\Exception $e) {
                Log::error('Image upload failed', ['error' => $e->getMessage()]);
                return response()->json(['message' => 'Failed to upload image.'], 500);
            }
        }

       
        return response()->json(['message' => 'No file uploaded or invalid file type.'], 400);
    }
}
