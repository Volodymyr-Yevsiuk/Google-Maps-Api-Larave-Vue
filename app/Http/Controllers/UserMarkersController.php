<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use App\Models\Marker;

class UserMarkersController extends Controller
{

    // Function which return info about markers for different roles of users
    public function index() {

        $userId = Auth::user()->id;

        if(Gate::denies('CHANGE_ALL_MARKERS')) {
            $markers = Marker::where('user_id', $userId)->get();
        } else {
            $markers = Marker::all();
        }
        
        
        return $markers;
    }
}
