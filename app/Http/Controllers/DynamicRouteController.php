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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = $request->page ? $request->page : 1;

        return  view('platform.index', [
            'platforms' => $this->platforms,
            'page' => $page
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DynamicRoute  $dynamicRoute
     * @return \Illuminate\Http\Response
     */
    public function show(DynamicRoute $dynamicRoute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DynamicRoute  $dynamicRoute
     * @return \Illuminate\Http\Response
     */
    public function edit(DynamicRoute $platform)
    {
        return response([
            'platform' => $platform,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DynamicRoute  $dynamicRoute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'route' => ['required', 'string', 'url'],
            'positive' => ['required', 'string'],
            'negative' => ['required', 'string'],
        ];

        $validatedData = $request->validate($rules, $this->messages);

        $dynamicRoute = DynamicRoute::findOrFail($request->id);

        $dynamicRoute->update($request->all());
        
        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DynamicRoute  $dynamicRoute
     * @return \Illuminate\Http\Response
     */
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
