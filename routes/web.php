<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserMarkersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\IndexAdminController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('markers/{id}', [HomeController::class, 'show'])->name('show');

Route::post('comment', [CommentController::class, 'store'])->name('comment');

Route::get('logout', [AuthController::class, 'logout']);

Route::get('/userMarkers', [UserMarkersController::class, 'index'])->middleware(['auth']);

// Admin
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {

    // admin/adminMarkers
    Route::resource('adminMarkers', IndexAdminController::class)->names(['index' => 'admin']);

});
