<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', function () {
    $expoPushToken = "ExponentPushToken[S2xWkaHhkS9s9qAV-eq7dF]";
    $message = [
        "to" => $expoPushToken, //hard code expo token now
        "title" => "Hlaing min than",
        "body" => "Min ga lar par",
        "data" => [
            "screen" => "/signin"
        ]
    ];
    $url = 'https://exp.host/--/api/v2/push/send';

    $response = Http::post($url, [
        'to' => $expoPushToken,
        'title' => $message['title'],
        'body' => $message['body'],
        'data' => $message['data'],
    ]);

    return $response->json();
});
