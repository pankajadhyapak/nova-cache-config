<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Card API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your card. These routes
| are loaded by the ServiceProvider of your card. You're free to add
| as many additional routes to this file as your card may require.
|
*/

Route::post('/', function (Request $request) {
    validator(\request()->all(), [
        'value' => 'required'. $request->has("type") ? "|".$request->get("type") : ""
    ])->validate();

    \Cache::forget($request->get("key"));
    \Cache::forever($request->get("key"), trim(request('value')));
});

Route::delete('/', function (Request $request) {
    \Cache::forget($request->get("key"));
});
