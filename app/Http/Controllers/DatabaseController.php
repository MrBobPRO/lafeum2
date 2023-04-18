<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DatabaseController extends Controller
{
    public function fixDBfromOldDB()
    {
        // Add new DayliPOst
        $post = new DailyPost();
        $post->date = now();
        $post->quote_id = '7';
        $post->term_id = '25';
        $post->video_id = '41';
        $post->photo_id = '20';
        $post->save();

        // Categories
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

        // Authors
        Author::withTrashed()->get()->each(function ($item) {
            $item->photo = substr($item->photo, 13);
            $item->save();
        });

        // Photos
        Photo::withTrashed()->get()->each(function ($item) {
            $item->path = substr($item->path, 13);
            $item->save();
        });
    }
}
