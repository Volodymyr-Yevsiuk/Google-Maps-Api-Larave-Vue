<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Marker;

class MarkerController extends Controller
{
    public function show($id) 
    {
        $marker = Marker::find($id);
        return $marker;
    }
}
