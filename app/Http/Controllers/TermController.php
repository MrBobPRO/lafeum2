<?php

namespace App\Http\Controllers;

use App\Models\Term;
use App\Http\Requests\StoreTermRequest;
use App\Http\Requests\UpdateTermRequest;
use App\Models\TermCategory;

class TermController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = TermCategory::get()->toTree();
        $terms = Term::published('desc')
            ->with([
                'categories',
                'termType'
            ])
            ->paginate(20);

        return view('terms.index', compact('categories', 'terms'));
    }

    public function category(TermCategory $category)
    {
        $categories = TermCategory::get()->toTree();
        $terms = $category->terms()->published('desc')
            ->with([
                'categories',
                'termType'
            ])
            ->paginate(20);

        return view('terms.category', compact('category' ,'categories', 'terms'));
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
    public function store(StoreTermRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Term $term)
    {
        $term = $term->load(['categories', 'termType']);

        return view('terms.show', compact('term'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Term $term)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTermRequest $request, Term $term)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Term $term)
    {
        //
    }
}
