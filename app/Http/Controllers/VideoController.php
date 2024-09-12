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

    public function videos(User $user)
    {
        try {
            return [
                'data' => $user->videos()->latest()->get(),
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
