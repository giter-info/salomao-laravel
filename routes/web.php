<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/{path?}', [SiteController::class, 'show'])
    ->where('path', '^(?!admin(?:/|$)).*');
