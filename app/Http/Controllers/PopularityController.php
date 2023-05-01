<?php

namespace App\Http\Controllers;

use App\Models\Popularity;
use App\Models\DynamicRoute;
use Illuminate\Http\Request;
use Illuminate\Http\Client\Response;
use App\Http\Services\CalculateScoreService;

class PopularityController extends Controller
{
    private const ITEM_PER_PAGE = 10;

    private $platforms;

    public function __construct()
    {
        $this->platforms = DynamicRoute::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = $request->page ? $request->page : 1;

        return view('popularity.index', [
            'popularities' => Popularity::with('dynamic_routes')->paginate($this::ITEM_PER_PAGE),
            'platforms' => $this->platforms,
            'page' => $page
        ]);
    }

    public function checkIssue(Request $request, CalculateScoreService $calculatedScore)
    {
        /*  With following, it would be more correct to perform the desired operation, but in the task it is written that in the case of an existing record, the urls to the platforms are not called:

            $popularity = Popularity::firstOrCreate(
                [
                    'term' => $request->term,
                    'dynamic_routes_id' => $request->platform_id,
                    'score' => $score->calculateRate(DynamicRoute::find($request->platform_id), $request->term)
                ]
            );
        */

        $validatedData = $request->validate([
                'term' => ['required', 'string', 'max:255'],
                'platform_id' => ['required'],
            ],
            [
                'term.string' => 'The Term must be a string.',
                'term.max' => 'The Term must contain a maximum of 255 characters.',
                'platform_id.required' => 'There is not a single API route at this time. Please create at least one.'
            ]
        );

        $check_existing_term = null;
            
        $popularity = Popularity::where('term', $request->term)
                                ->where('dynamic_routes_id', $request->platform_id)
                                ->first();

        if(is_null($popularity)){

            $score = $calculatedScore->calculateScore(DynamicRoute::find($request->platform_id), $request->term);
            $check_existing_term = 1;

            if(!is_null($score)){                
                $popularity = Popularity::create(
                    [
                        'term' => $request->term,
                        'dynamic_routes_id' => $request->platform_id,
                        'score' => $score,
                    ]
                );
            }
            else {
                return response()->json(['message' => 'No data!'], 404);
            }
        }

        return response()->json([
            'check_existing_term' => $check_existing_term,
            'term' => $popularity->term,
            'platform_name' => DynamicRoute::find($request->platform_id)->title,
            'score' =>$popularity->score
        ], 200);
        
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Popularity  $popularity
     * @return \Illuminate\Http\Response
     */
    public function show(Popularity $popularity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Popularity  $popularity
     * @return \Illuminate\Http\Response
     */
    public function edit(Popularity $popularity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Popularity  $popularity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Popularity $popularity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Popularity  $popularity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Popularity $popularity)
    {
        //
    }

}
