<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('stats', function () {
    return [
        'series' => 200,
        'lessons' => 1300,
    ];
});

Route::get('achievements', function () {
    return [['name' => 1], ['name' => 2]];
    // $user = request()->user()->first()->achievements;

    // return $user->achievements;
})->middleware('auth:api');
