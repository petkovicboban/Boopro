<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class CalculateScoreService
{
    public function calculateScore($dynamic_route, $term)
    {
        $route_bad = Http::get($dynamic_route->route . $term . '+' . $dynamic_route->negative);
        $route_good = Http::get($dynamic_route->route . $term . '+' . $dynamic_route->positive);

        if ($route_bad->ok() && $route_good->ok() && $route_good['total_count'] + $route_bad['total_count'] > 0) {
            return number_format($route_good['total_count']/($route_good['total_count'] + $route_bad['total_count'])*10, 2); 
        }

        return null;
    }
}