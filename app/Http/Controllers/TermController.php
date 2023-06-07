<?php

namespace App\Http\Controllers;

use App\Models\Term;
use App\Http\Requests\StoreTermRequest;
use App\Http\Requests\UpdateTermRequest;
use App\Models\Knowledge;
use App\Models\TermCategory;
use App\Models\TermType;
use App\Support\Helpers\Helper;
use Illuminate\Http\Request;

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

        return view('terms.category', compact('category', 'categories', 'terms'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Term $term)
    {
        $term = $term->load(['categories', 'termType']);

        return view('terms.show', compact('term'));
    }


    // ******************** DASHBOARD ROUTES START ********************

    public function dashboardIndex(Request $request)
    {
        // order parameters
        $params = Helper::generatePageParams($request, 'publish_at', 'desc');

        // used in search & counter
        $allItems = Term::select('id')->get();
        $items = $this->getTermsForDash($request, $params, $onlyTrashed = false);

        return view('dashboard.terms.index', compact('params', 'items', 'allItems'));
    }

    public function dashboardTrash(Request $request)
    {
        // order parameters
        $params = Helper::generatePageParams($request, 'publish_at', 'desc');

        // used in search & counter
        $allItems = Term::onlyTrashed()->select('id')->get();
        $items = $this->getTermsForDash($request, $params, $onlyTrashed = true);

        return view('dashboard.terms.trash', compact('params', 'items', 'allItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = $this->getTypesForDash();
        $knowledges = $this->getKnowledgesForDash();
        $categories = $this->getCategoriesForDash();

        return view('dashboard.terms.create', compact('types', 'knowledges', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuoteRequest $request)
    {
        $quote = Quote::create($request->all());
        $quote->categories()->attach($request->input('categories'));

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
        $item = Quote::find($request->id);
        $item->update($request->all());
        $item->categories()->sync($request->input('categories'));

        return redirect($request->input('previous_url'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // Permanent Delete
        if ($request->has('permanently')) {
            foreach ($request->input('id') as $id) {
                Quote::withTrashed()->find($id)->forceDelete();
            }

            return redirect()->route('quotes.dashboard.trash');
        }

        // Trash
        foreach ($request->input('id') as $id) {
            Quote::find($id)->delete();
        }

        return redirect()->route('quotes.dashboard.index');
    }

    public function restore(Request $request)
    {
        Quote::onlyTrashed()->find($request->input('id'))->restore();

        return redirect()->back();
    }

    private function getTermsForDash($request, $params, $onlyTrashed = false)
    {
        $items = Term::query();

        if($onlyTrashed) {
            $items = $items->onlyTrashed();
        }

        $items = $items->where('terms.body', 'LIKE', '%' . $params['keyword'] . '%')
            ->join('term_types', 'terms.term_type_id', '=', 'term_types.id')
            ->select('terms.id', 'terms.name', 'terms.body', 'terms.publish_at', 'term_types.name as type')
            ->orderBy($params['orderBy'], $params['orderType'])
            ->with(['knowledges', 'categories'])
            ->paginate(30, ['*'], 'page', $params['currentPage'])
            ->appends($request->except('page'));

        return $items;
    }

    private function getTypesForDash()
    {
        $items = TermType::orderBy('name', 'asc')
            ->get();

        return $items;
    }

    private function getKnowledgesForDash()
    {
        $items = Knowledge::orderBy('name', 'asc')
            ->select('name', 'id')
            ->get();

        return $items;
    }

    private function getCategoriesForDash()
    {
        $items = TermCategory::orderBy('name', 'asc')
            ->select('name', 'id')
            ->get();

        return $items;
    }
}
