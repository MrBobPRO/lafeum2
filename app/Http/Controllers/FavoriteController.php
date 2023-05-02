<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Http\Requests\StoreFavoriteRequest;
use App\Http\Requests\UpdateFavoriteRequest;
use App\Models\Quote;
use App\Models\Term;
use App\Models\Video;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function toggle(Request $request)
    {
        $model = $request->model;
        $favoritableModels = array(Quote::class, Term::class, Video::class);

        // escape hacks
        if (in_array($model, $favoritableModels)) {
            $instance = $model::find($request->id);
            $user = request()->user();

            // Toggle Favorite
            if ($instance->favoritedBy($user)) {
                $instance->favorites()->where('user_id', $user->id)->first()->delete();

                return 'unfavorited';
            } else {
                $favorite = new Favorite(['user_id' => $user->id]);
                $instance->favorites()->save($favorite);

                return 'favorited';
            }
        }
    }

    public function quotes()
    {
        $quotes = auth()->user()->favoriteQuotes()->
        with([
            'author:id,name,slug',
            'categories:id,name,slug'
        ])
            ->published('desc')
            ->paginate(20);

        return view('favorites.quotes', compact('quotes'));
    }

    public function terms()
    {
        $terms = auth()->user()->favoriteTerms()
        ->with([
            'categories',
            'termType'
        ])
        ->published('desc')
        ->paginate(20);

        return view('favorites.terms', compact('terms'));
    }

    public function videos()
    {
        $videos = auth()->user()->favoriteVideos()
        ->with([
            'channel:id,name,slug',
            'categories',
        ])
            ->published('desc')
            ->paginate(20);

        return view('favorites.videos', compact('videos'));
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFavoriteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Favorite $favorite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFavoriteRequest $request, Favorite $favorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Favorite $favorite)
    {
        //
    }
}
