<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        try {
            return [
                'data' => $user,
                'status' => 'success',
            ];
        } catch (Exception $e) {
            return [
                'message' => $e->getMessage(),
                'status' => 'error',
            ];
        }
    }

    public function bookmarks()
    {
        try {
            return [
                'data' => auth()->user()->bookmarkedVideos()->where("title", "like", "%" . request('query') . "%")->get(),
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
