<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Http\Requests\StoreLikeRequest;
use App\Http\Requests\UpdateLikeRequest;
use App\Models\Quote;
use App\Models\Term;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class LikeController extends Controller
{
    public function toggle(Request $request)
    {
        $model = $request->model;
        $likeableModels = array(Quote::class, Term::class, Video::class);

        // escape hacks
        if (in_array($model, $likeableModels)) {
            $instance = $model::find($request->modelID);
            $user = request()->user();

            if($instance->likedBy($user)) {
                $instance->likes()->delete();
                return 'unliked';

            } else {
                $like = new Like(['user_id' => $user->id]);
                $instance->likes()->save($like);
                return 'liked';
            }
        }
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = request()->user();
        $items = $user->getLikedItems();

        // Manual Pagination
        $options = ['path' => url()->current()];
        $perPage = 20;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $items->forPage($currentPage, $perPage);

        $paginatedItems = new LengthAwarePaginator($currentItems, count($items), $perPage, $currentPage, $options);

        return view('likes.index', compact('paginatedItems'));
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
    public function store(StoreLikeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLikeRequest $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Like $like)
    {
        //
    }
}
