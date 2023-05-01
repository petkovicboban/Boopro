<?php

namespace App\Http\Controllers;

use App\Models\DynamicRoute;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class DynamicRouteController extends Controller
{
    private const ITEM_PER_PAGE = 10;

    private $platforms;
    private $messages;

    public function __construct()
    {
        $this->platforms = DynamicRoute::paginate($this::ITEM_PER_PAGE);
        $this->messages = [
            'title.required' => 'The Platform name is required.',
            'title.string' => 'The Platform name must be a string!',
            'title.max' => 'The Platform name must contain a maximum of 255 characters.',
            'title.unique' => 'The Platform name has already been taken.',
            'route.required' => 'API route is required.',
            'route.string' => 'API route must be a string!',
            'route.url' => 'API route must be a valid URL.',
            'route.unique' => 'API route has already been taken.',
            'positive.required' => 'Prefix for positive results is required!',
            'positive.string' => 'Prefix for positive results must be a string!',
            'negative.required' => 'Prefix for negative results is required!',
            'negative.string' => 'Prefix for negative results must be a string!',
        ];
    }

    public function index(Request $request)
    {
        $page = $request->page ? $request->page : 1;

        return  view('platform.index', [
            'platforms' => $this->platforms,
            'page' => $page
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => ['required', 'string', 'max:255', 'unique:dynamic_routes'],
            'route' => ['required', 'string', 'url', 'unique:dynamic_routes'],
            'positive' => ['required', 'string'],
            'negative' => ['required', 'string'],
        ];

        $validatedData = $request->validate($rules, $this->messages);

        DynamicRoute::create([
            'title' => $request->title,
            'route' => $request->route,
            'positive' => $request->positive,
            'negative' => $request->negative,
        ]);
    }

    public function edit(DynamicRoute $platform)
    {
        return response([
            'platform' => $platform,
        ]);
    }

    public function update(Request $request, $platform)
    {
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'route' => ['required', 'string', 'url'],
            'positive' => ['required', 'string'],
            'negative' => ['required', 'string'],
        ];

        $validatedData = $request->validate($rules, $this->messages);

        $dynamicRoute = DynamicRoute::findOrFail($platform);

        $dynamicRoute->update($request->all());
        
        return;
    }

    public function destroy(DynamicRoute $platform)
    {
        $platform->delete();
        return ;
    }

    public function getPlatforms()
    {
        return response([
            'platforms'=> $this->platforms,
        ]);
    }    
}
