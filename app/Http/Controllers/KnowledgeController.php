<?php

namespace App\Http\Controllers;

use App\Models\Knowledge;
use App\Http\Requests\StoreKnowledgeRequest;
use App\Http\Requests\UpdateKnowledgeRequest;

class KnowledgeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $knowledge = Knowledge::get()->toTree();

        return view('knowledge.index', compact('knowledge'));
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
    public function store(StoreKnowledgeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Knowledge $knowledge)
    {
        $allKnowledge = Knowledge::get()->toTree();
        $terms = $knowledge
            ->terms()
            ->with([
                'categories',
                'termType',
            ])
            ->orderBy('term_type_id', 'asc')
            ->published('desc')
            ->paginate(20);

        return view('knowledge.show', compact('allKnowledge', 'terms', 'knowledge'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Knowledge $knowledge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKnowledgeRequest $request, Knowledge $knowledge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Knowledge $knowledge)
    {
        //
    }
}
