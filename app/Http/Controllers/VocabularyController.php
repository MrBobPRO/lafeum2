<?php

namespace App\Http\Controllers;

use App\Models\Term;
use App\Models\TermCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class VocabularyController extends Controller
{
    public function index()
    {
        $categories = TermCategory::get()->toTree();
        $terms = Term::vocabulary()->published()->select('id', 'name')->orderBy('name')->get();

        return view('vocabulary.index', compact('categories', 'terms'));
    }

    public function getBody(Term $term)
    {
        return $term->body;
    }

    public function category(TermCategory $category)
    {
        $categories = TermCategory::get()->toTree();
        $terms = $category->terms()
            ->vocabulary()
            ->published()
            ->select('id', 'name')
            ->orderBy('name')
            ->get();

        return view('vocabulary.category', compact('category', 'categories', 'terms'));
    }

    public function search(Request $request)
    {
        // return all categories terms if keyword is null
        if($request->keyword == '') {
            $terms = TermCategory::find($request->categoryId)
                ->terms()
                ->vocabulary()
                ->published()
                ->select('id', 'name')
                ->orderBy('name')
                ->get();
        // else return results from all categories
        } else {
            $terms = Term::vocabulary()
            ->published()
            ->where('name', 'LIKE', "%{$request->keyword}%")
            ->select('id', 'name')
            ->orderBy('name')
            ->get();
        }

        return View::make('components.vocabulary-list', compact('terms'))->render();
    }
}
