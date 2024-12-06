<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Picture;
use App\Services\ImageService;
use Yaza\LaravelGoogleDriveStorage\Gdrive;
use App\Events\ImageUploaded; 
use Illuminate\Support\Facades\Log;

class PictureController extends Controller
{
    protected $imageService;
    public $image;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;

    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('file')) {
        $file = $request->file('file');

        try {
            $localPath = $this->imageService->compressAndSave($file);

            dispatch(function () use ($localPath) {
                $folderPath = env('GOOGLE_DRIVE_FOLDER');
                $fullFilePath = public_path($localPath);

                if (file_exists($fullFilePath)) {
                    Gdrive::put("{$folderPath}/{$localPath}", $fullFilePath);
                } else {
                    Log::error("File does not exist at path: {$fullFilePath}");
                    throw new \Exception("File not found for upload.");
                }
            });

            $image = new Picture();
            $image->image_url = $localPath; 
            $image->save();

            broadcast(new ImageUploaded(asset($localPath)));

            return response()->json([
                'message' => 'Image uploaded successfully!',
                'image_url' => asset($localPath),
            ], 200);

        } catch (\Exception $e) {
            Log::error('Image upload failed', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Failed to upload image.'], 500);
        }
    }

    return response()->json(['message' => 'No file uploaded or invalid file type.'], 400);
}

}
