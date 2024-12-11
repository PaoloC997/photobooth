<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use App\Models\Picture;

class RetrieveFileController extends Controller
{
    /**
     * Handle the incoming request and return all images from local storage.
     */
    public function __invoke(Request $request): JsonResponse
    {
        try {
          
            $pictures = Picture::all(); 

            if ($pictures->isEmpty()) {
                return response()->json(['message' => 'No images found.'], 404);
            }

            $images = $pictures->map(function ($picture) {
                
                return [
                    'image_url' => $picture->image_url,
                    'public_url' => asset($picture->image_url),
                ];
            });

            return response()->json([
                'images' => $images,
            ], 200);

        } catch (\Exception $e) {
           
            Log::error('Image retrieval failed', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Failed to retrieve images.'], 500);
        }
    }
}
