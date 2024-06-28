<?php

use App\Http\Controllers\Ai\PostController;
use App\Http\Controllers\Ai\SettingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::prefix('posts')->as('posts.')
    ->controller(PostController::class)
    ->group(function (){
        Route::get('/create','create')->name('create');
        Route::post('generateGptText','generateGptText')->name('generateGptText');
    });
Route::prefix('setting')->as('setting.')
    ->controller(SettingController::class)
    ->group(function (){
        Route::get('/create','create')->name('create');
        Route::put('/updateSetting','updateSetting')->name('updateSetting');
    });
