<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\Models\VideoCategory;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = VideoCategory::get()->toTree();

        $videos = Video::with([
            'channel:id,name,slug',
            'categories',
        ])
            ->published('desc')
            ->paginate(20);

        return view('videos.index', compact('categories', 'videos'));
    }

    public function category(VideoCategory $category)
    {
        $categories = VideoCategory::get()->toTree();

        $videos = $category->videos()->with([
            'channel:id,name,slug',
            'categories',
        ])
            ->published('desc')
            ->paginate(20);

        return view('videos.category', compact('category', 'categories', 'videos'));
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
    public function store(StoreVideoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        $video = $video->load([
            'channel:id,name,slug',
            'categories',
        ]);

        return view('videos.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVideoRequest $request, Video $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        //
    }
}
