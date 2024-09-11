<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

Route::get('/user', function (Request $request) {
    try {
        return $request->user();
    } catch (Exception $e) {
        return response()->json([
            'message' => $e->getMessage()
        ], 401);
    }
})->middleware('auth:sanctum');


Route::post('/auth/login', function (Request $request) {
    try {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        return $user->createToken($request->device_name)->plainTextToken;
    } catch (ValidationException $e) {
        return response()->json([
            'message' => $e->getMessage()
        ], 422);
    }
});

Route::post('/auth/register', function (Request $request) {
    try {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'device_name' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        return $user->createToken($request->device_name)->plainTextToken;
    } catch (ValidationException $e) {
        return response()->json([
            'message' => $e->getMessage()
        ], 422);
    }
});
