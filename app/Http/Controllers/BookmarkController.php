<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function toggle(Video $video)
    {
        try {
            if ($video->alreadyBookmarked()) {
                auth()->user()->bookmarkedVideos()->detach($video->id);
            } else {
                auth()->user()->bookmarkedVideos()->attach($video->id);
            }
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
