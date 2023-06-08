<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Http\Requests\StoreQuoteRequest;
use App\Http\Requests\UpdateQuoteRequest;
use App\Models\Author;
use App\Models\QuoteCategory;
use App\Support\Helpers\Helper;
use App\Support\Traits\Destroyable;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    use Destroyable;

    // used in Destroyable Trait
    public $model = Quote::class;
    public $modelTag = 'quotes';

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
     * Display the specified resource.
     */
    public function show(Quote $quote)
    {
        return view('quotes.show', compact('quote'));
    }


    // ******************** DASHBOARD ROUTES START ********************

    public function dashboardIndex(Request $request)
    {
        // order parameters
        $params = Helper::generatePageParams($request, 'publish_at', 'desc');

        // used in search & counter
        $allItems = Quote::select('id')->get();
        $items = $this->getQuotesForDash($request, $params, $onlyTrashed = false);

        return view('dashboard.quotes.index', compact('params', 'items', 'allItems'));
    }

    public function dashboardTrash(Request $request)
    {
        // order parameters
        $params = Helper::generatePageParams($request, 'publish_at', 'desc');

        // used in search & counter
        $allItems = Quote::onlyTrashed()->select('id')->get();
        $items = $this->getQuotesForDash($request, $params, $onlyTrashed = true);

        return view('dashboard.quotes.trash', compact('params', 'items', 'allItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = $this->getAuthorsForDash();
        $categories = $this->getCategoriesForDash();

        return view('dashboard.quotes.create', compact('authors', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuoteRequest $request)
    {
        $item = Quote::create($request->all());
        $item->categories()->attach($request->input('categories'));

        return redirect()->route('quotes.dashboard.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quote $item)
    {
        $item->load(['categories', 'author']);
        $authors = $this->getAuthorsForDash();
        $categories = $this->getCategoriesForDash();

        return view('dashboard.quotes.edit', compact('authors', 'categories', 'item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuoteRequest $request, Quote $item)
    {
        $item = Quote::find($request->all());
        $item->update($request->all());
        $item->categories()->sync($request->input('categories'));

        return redirect($request->input('previous_url'));
    }

    private function getQuotesForDash($request, $params, $onlyTrashed = false)
    {
        $items = Quote::query();

        if($onlyTrashed) {
            $items = $items->onlyTrashed();
        }

        $items = $items->where('quotes.body', 'LIKE', '%' . $params['keyword'] . '%')
        ->join('authors', 'quotes.author_id', '=', 'authors.id')
        ->select('quotes.id', 'quotes.body', 'quotes.notes', 'quotes.publish_at', 'authors.name as author')
        ->orderBy($params['orderBy'], $params['orderType'])
        ->with('categories')
        ->paginate(30, ['*'], 'page', $params['currentPage'])
        ->appends($request->except('page'));

        return $items;
    }

    private function getAuthorsForDash()
    {
        $items = Author::orderBy('name', 'asc')
            ->select('name', 'id')
            ->get();

        return $items;
    }

    private function getCategoriesForDash()
    {
        $items = QuoteCategory::orderBy('name', 'asc')
            ->select('name', 'id')
            ->get();

        return $items;
    }
}
