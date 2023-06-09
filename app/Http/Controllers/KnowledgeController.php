<?php

namespace App\Http\Controllers;

use App\Models\Knowledge;
use App\Http\Requests\StoreKnowledgeRequest;
use App\Http\Requests\UpdateKnowledgeRequest;
use App\Support\Helpers\Helper;
use App\Support\Traits\Destroyable;
use Illuminate\Http\Request;

class KnowledgeController extends Controller
{
    use Destroyable;

    // used in Destroyable Trait
    public $model = Knowledge::class;
    public $modelTag = 'knowledge';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $knowledge = Knowledge::get()->toTree();

        return view('knowledge.index', compact('knowledge'));
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

    // ******************** DASHBOARD ROUTES START ********************

    public function dashboardIndex(Request $request)
    {
        // order parameters
        $params = Helper::generatePageParams($request, 'name', 'asc');

        // used in search & counter
        $allItems = Knowledge::orderBy('name')->select('id', 'name')->get();

        $items = Knowledge::with('parent')
            ->withCount('terms')
            ->orderBy($params['orderBy'], $params['orderType'])
            ->paginate(30, ['*'], 'page', $params['currentPage'])
            ->appends($request->except('page'));

        return view('dashboard.knowledge.index', compact('params', 'items', 'allItems'));
    }

    public function editNestedset(Request $request)
    {
        $items = Knowledge::defaultOrder()->get()->toTree();

        return view('dashboard.knowledge.edit-structure', compact('items'));
    }

    public function updateNestedset(Request $request)
    {
        // pluck all items id
        $itemIDs = collect($request->itemsArray)->pluck('id');

        // pluck all removed items id
        $removedIDs = Knowledge::whereNotIn('id', $itemIDs)->pluck('id');

        // Delte items explicitly (for correct working of model events)
        foreach($removedIDs as $id) {
            Knowledge::find($id)->delete();
        }

        Knowledge::rebuildTree($request->itemsHierarchy, true);
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
    public function store(StoreKnowledgeRequest $request)
    {
        $item = Term::create($request->all());
        $item->categories()->attach($request->input('categories'));
        $item->knowledges()->attach($request->input('knowledges'));

        return redirect()->route('terms.dashboard.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Knowledge $item)
    {
        $item->load(['categories', 'knowledges']);

        $types = $this->getTypesForDash();
        $knowledges = $this->getKnowledgesForDash();
        $categories = $this->getCategoriesForDash();

        return view('dashboard.terms.edit', compact('item', 'types', 'knowledges', 'categories',));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKnowledgeRequest $request, Term $item)
    {
        $item = Term::find($request->id);
        $item->update($request->all());
        $item->categories()->sync($request->input('categories'));
        $item->knowledges()->sync($request->input('knowledges'));

        return redirect($request->input('previous_url'));
    }

    private function getTermsForDash($request, $params, $onlyTrashed = false)
    {
        $items = Term::query();

        if($onlyTrashed) {
            $items = $items->onlyTrashed();
        }

        $items = $items->where('terms.body', 'LIKE', '%' . $params['keyword'] . '%')
            ->join('term_types', 'terms.term_type_id', '=', 'term_types.id')
            ->select('terms.id', 'terms.name', 'terms.body', 'terms.show_in_vocabulary', 'terms.publish_at', 'term_types.name as type')
            ->orderBy($params['orderBy'], $params['orderType'])
            ->with(['knowledges', 'categories'])
            ->paginate(30, ['*'], 'page', $params['currentPage'])
            ->appends($request->except('page'));

        return $items;
    }
}
