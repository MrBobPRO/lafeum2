<?php

namespace App\Http\Controllers;

use App\Models\DailyPost;
use App\Http\Requests\StoreDailyPostRequest;
use App\Http\Requests\UpdateDailyPostRequest;

class DailyPostController extends Controller
{
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
    public function store(StoreDailyPostRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DailyPost $dailyPost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DailyPost $dailyPost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDailyPostRequest $request, DailyPost $dailyPost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DailyPost $dailyPost)
    {
        //
    }
}
