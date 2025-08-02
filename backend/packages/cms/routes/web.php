<?php

use Illuminate\Support\Facades\Route;

use User\LaravelCms\Http\Controllers\Cms\ParamController;
use User\LaravelCms\Http\Controllers\Cms\UserController;

Route::resource('params', ParamController::class);
Route::resource('users', UserController::class);