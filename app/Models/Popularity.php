<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Popularity extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function dynamic_routes()
    {
        return $this->belongsTo(DynamicRoute::class);
    }
}
