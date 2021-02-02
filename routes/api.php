<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MarkerController;
use App\Models\Marker;

Route::get('/markers', function() {
    return Marker::all();
});

Route::get('/markers/{id}', [MarkerController::class, 'show']);
