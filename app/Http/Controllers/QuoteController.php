<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Http\Requests\StoreQuoteRequest;
use App\Http\Requests\UpdateQuoteRequest;
use App\Models\QuoteCategory;
use App\Support\Helpers\Helper;
use Illuminate\Http\Request;

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

        return view('quotes.category', compact('category', 'categories', 'quotes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function dashboardIndex(Request $request)
    {
        // order parameters
        $params = Helper::generatePageParams($request, 'publish_at', 'desc');

        // search keyword maybe used
        $params['keyword'] = $request->keyword;

        // used in search & counter
        $allItems = Quote::select('id')->get();
        $items = Quote::where('quotes.body', 'LIKE', '%' . $params['keyword'] . '%')
            ->join('authors', 'quotes.author_id', '=', 'authors.id')
            ->select('quotes.id', 'quotes.body', 'quotes.notes', 'quotes.publish_at', 'authors.name as author')
            ->orderBy($params['orderBy'], $params['orderType'])
            ->with('categories')
            ->paginate(30, ['*'], 'page', $params['currentPage'])
            ->appends($request->except('page'));

        return view('dashboard.quotes.index', compact('params', 'items', 'allItems'));
    }

    public function dashboardSearch(Request $request)
    {
        // order parameters
        $params = Helper::generatePageParams($request, 'publish_at', 'desc');
        $params['keyword'] = $request->keyword;

        // used in search & counter
        $items = Quote::where('quotes.body', 'LIKE', '%' . $params['keyword'] . '%')
            ->join('authors', 'quotes.author_id', '=', 'authors.id')
            ->select('quotes.id', 'quotes.body', 'quotes.notes', 'quotes.publish_at', 'authors.name as author')
            ->orderBy($params['orderBy'], $params['orderType'])
            ->with('categories')
            ->paginate(30, ['*'], 'page', $params['currentPage'])
            ->appends(['keyword' => $request->keyword]);

        $items->withPath(route('quotes.dashboard.index'));

        return view('dashboard.tables.quotes', compact('params', 'items'));
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
    public function destroy(Request $request)
    {
        dd($request->input('id'));
    }
}
