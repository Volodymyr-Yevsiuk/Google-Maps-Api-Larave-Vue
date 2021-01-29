<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Marker;
use App\Http\Resources\MarkerResource;

class MarkerController extends Controller
{
    public function show($id) {
        $marker = Marker::find($id);
        return $marker;
    }
}
