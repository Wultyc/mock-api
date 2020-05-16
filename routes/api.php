<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'mgmt'], function() {
    Route::get('', 'MockManagementController@list')->where('endpoint', '(.*)');
    Route::post('', 'MockManagementController@insert')->where('endpoint', '(.*)');
});

Route::get('{endpoint}', 'MockResourceController@get')->where('endpoint', '(.*)');
Route::post('{endpoint}', 'MockResourceController@post')->where('endpoint', '(.*)');
Route::put('{endpoint}', 'MockResourceController@put')->where('endpoint', '(.*)');
Route::patch('{endpoint}', 'MockResourceController@patch')->where('endpoint', '(.*)');
Route::delete('{endpoint}', 'MockResourceController@delete')->where('endpoint', '(.*)');