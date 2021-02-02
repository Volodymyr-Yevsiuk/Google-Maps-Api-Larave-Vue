<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'text', 'user_id', 'marker_id', 'email'];

    public function marker() 
    {
        return $this->belongsTo('App\Models\Marker');
    }

    public function user() 
    {
        return $this->belongsTo('App\Models\User');
    }
}
