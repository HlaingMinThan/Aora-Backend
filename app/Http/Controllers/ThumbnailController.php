<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class ThumbnailController extends Controller
{
    public function store()
    {
        // try {
        // Validate the image
        request()->validate([
            'image' => 'required|file|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Check if the request has a file and store it
        if ($image = request()->file('image')) {
            // Store the file and get the path
            $path = $image->store('images', 'public');

            // Return the stored file path
            return response()->json([
                'uri' => '/storage/' . $path,
            ]);
        } else {
            return response()->json(['message' => 'No file uploaded'], 400);
        }
        // } catch (Exception $e) {
        //     return response()->json([
        //         'message' => $e->getMessage(),
        //     ], 422);
        // }
    }
}
