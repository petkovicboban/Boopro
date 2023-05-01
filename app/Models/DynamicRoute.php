<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DynamicRoute extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function popularities()
    {
        return $this->hasMany(Popularity::class);
    }
}
