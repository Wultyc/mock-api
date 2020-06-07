<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'welcome')->name('home');
Route::view('/HowToUse', 'howToUse')->name('howToUse');
Route::view('/Mocks', 'mocks')->name('mocks');
Route::get('/Mocks/Watch/{endpoint}', 'MainController@watch')->where('endpoint', '(.*)')->name('watch');


