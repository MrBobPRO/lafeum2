<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{

    /**
     * *****************************************
     * Helpers needed while validating database
     */

    public function validateDatabase()
    {
        Category::all()->each(function ($item) {
            $model = $item->type . 'Category';

            $category = new $model();
            $category->id = $item->id;
            $category->name = $item->name;
            $category->slug = $item->slug;
            $category->description = $item->description;
            $category->_lft = $item->_lft;
            $category->_rgt = $item->_rgt;
            $category->parent_id = $item->parent_id;
            $category->save();
        });
    }



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
    public function store(StoreCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
