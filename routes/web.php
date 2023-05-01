<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PopularityController;
use App\Http\Controllers\DynamicRouteController;

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

Route::get('/', [PopularityController::class, 'index'])->name('popularity.index');
Route::post('/check-issue', [PopularityController::class, 'checkIssue'])->name('check.issue');

Route::resource('popularity', PopularityController::class);

Route::resource('platform', DynamicRouteController::class);

Route::put('/update', [DynamicRouteController::class, 'update']);
Route::get('/get-platforms', [DynamicRouteController::class, 'getPlatforms']);
Route::post('/new-platform', [DynamicRouteController::class, 'newPlatform'])->name('new.platform');

