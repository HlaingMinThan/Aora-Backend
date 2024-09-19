<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use Exception;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        try {
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

    public function checkBookmark(Video $video)
    {
        try {
            return [
                'data' => $video->alreadyBookmarked(),
                'status' => 'success',
            ];
        } catch (Exception $e) {
            return [
                'message' => $e->getMessage(),
                'status' => 'error',
            ];
        }
    }

    public function store()
    {
        $attrs = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'thumbnail' => 'required',
        ]);

        $attrs['user_id'] = auth()->id();
        $attrs['video'] = "http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ElephantsDream.mp4"; //will use uploaded video later

        return response()->json([
            'data' => Video::create($attrs),
            'status' => 'success',
        ]);
    }

    public function videos(User $user)
    {
        try {
            return [
                'data' => $user->videos()->with('creator')->latest()->get(),
            ];
        } catch (Exception $e) {
            return [
                'message' => $e->getMessage(),
                'status' => 'error',
            ];
        }
    }

    public function trending()
    {
        try {
            return [
                'data' => Video::with('creator')->inRandomOrder()->take(6)->latest()->get(),
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
