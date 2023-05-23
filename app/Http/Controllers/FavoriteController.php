<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Http\Requests\StoreFavoriteRequest;
use App\Http\Requests\UpdateFavoriteRequest;
use App\Models\Folder;
use App\Models\Quote;
use App\Models\Term;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Route;

class FavoriteController extends Controller
{
    public function toggle(Request $request)
    {
        $model = $request->model;
        $favoritableModels = array(Quote::class, Term::class, Video::class);

        // escape hacks
        if (in_array($model, $favoritableModels)) {
            $instance = $model::find($request->modelID);
            $folderIDs = $request->folderIDs;
            $user = request()->user();

            // Refresh Favorites
            $instance->favorites()->where('user_id', $user->id)->delete();

            foreach($folderIDs as $id) {
                $favorite = new Favorite(['user_id' => $user->id, 'folder_id' => $id]);
                $instance->favorites()->save($favorite);
            }
        }

        return count($folderIDs) ? 'favorited' : 'unfavorited';
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $folders = request()->user()->rootFolders;

        return view('favorites.index', compact('folders'));
    }

    public function folder($id)
    {
        $user = request()->user();
        $folder = Folder::where('id', $id)->where('user_id', $user->id)->firstOrFail();
        $items = $user->getFoldersItems($folder->id);

        // Manual Pagination
        $options = ['path' => url()->current()];
        $perPage = 20;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $items->forPage($currentPage, $perPage);

        $paginatedItems = new LengthAwarePaginator($currentItems, count($items), $perPage, $currentPage, $options);

        return view('favorites.folder', compact('folder', 'paginatedItems'));
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
