<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Http\Requests\StoreQuoteRequest;
use App\Http\Requests\UpdateQuoteRequest;
use App\Models\QuoteCategory;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = QuoteCategory::get()->toTree();
        $quotes = Quote::with([
            'author:id,name,slug',
            'categories:id,name,slug'
        ])
            ->published('desc')
            ->paginate(20);

        return view('quotes.index', compact('categories', 'quotes'));
    }

    public function category(QuoteCategory $category)
    {
        $categories = QuoteCategory::get()->toTree();
        $quotes = $category->quotes()->with([
            'author:id,name,slug',
            'categories:id,name,slug'
        ])
            ->published('desc')
            ->paginate(20);

        return view('quotes.category', compact('category' ,'categories', 'quotes'));
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
    public function store(StoreQuoteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Quote $quote)
    {
        return view('quotes.show', compact('quote'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quote $quote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuoteRequest $request, Quote $quote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quote $quote)
    {
        //
    }
}
