<?php

use Illuminate\Support\Facades\Route;

use User\LaravelCms\Http\Controllers\Cms\AuthController;
use User\LaravelCms\Http\Controllers\Cms\UserController;
use User\LaravelCms\Http\Controllers\Cms\ParamController;

Route::get('/cms/login', [AuthController::class, 'showLogin'])
  ->name('show.login');

Route::post('/cms/login', [AuthController::class, 'login'])
  ->name('login'); 

Route::get('/cms/logout', [AuthController::class, 'logout'])
  ->name('logout');


Route::get('/dashboard', fn() => view('cms::app'))->name('cms.dashboard');


Route::prefix('cms')->name('cms.')->group(function () {
  Route::resource('params', ParamController::class);
  Route::resource('users', UserController::class);
});