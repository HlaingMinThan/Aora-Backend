<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Exception;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        try {
            logger(request()->all());
            $query = request('query');
            logger($query . 'logged');
            return [
                'data' => Video::with('creator')->where('title', 'like', '%' . $query . '%')
                    // ->orWhere('description', 'like', '%' . $query . '%')
                    ->latest()->get(),
                'status' => 'success',
            ];
        } catch (Exception $e) {
            return [
                'message' => $e->getMessage(),
                'status' => 'error',
            ];
        }
    }

    public function show(Video $video)
    {
        try {
            return [
                'data' => $video->load('creator'),
                'status' => 'success',
            ];
        } catch (Exception $e) {
            return [
                'message' => $e->getMessage(),
                'status' => 'error',
            ];
        }
    }
}
