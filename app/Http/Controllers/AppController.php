<?php

namespace App\Http\Controllers;

use App\Models\QuoteCategory;
use App\Models\TermCategory;
use App\Models\VideoCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Kalnoy\Nestedset\Collection as NestedsetCollection;

class AppController extends Controller
{
    public function home()
    {
        // Join all categories
        $categories = new NestedsetCollection();
        $categories = $categories->concat(QuoteCategory::orderBy('_lft')->get()->toTree());
        $categories = $categories->concat(TermCategory::orderBy('_lft')->get()->toTree());
        $categories = $categories->concat(VideoCategory::orderBy('_lft')->get()->toTree());
        $categories = $categories->unique('name');

        // Add supported types
        $categories->each(function ($item) {
            foreach($item->children as $child) {
                $child->supportedTypeLinks = $this->getSupportedTypeLinks($child);
            }
        });

        return view('pages.home', compact('categories'));
    }

    public function aboutUs()
    {
        return view('pages.about-us');
    }

    private function getSupportedTypeLinks($category)
    {
        $links = [];

        if (QuoteCategory::where('name', $category->name)->first()) {
            $links[] = [
                'label' => 'Цитаты и Афоризмы',
                'href' => route('quotes.category', $category->slug)
            ];
        }

        if (TermCategory::where('name', $category->name)->first()) {
            $links[] = [
                'label' => 'Термины',
                'href' => route('terms.category', $category->slug)
            ];
        }

        if (VideoCategory::where('name', $category->name)->first()) {
            $links[] = [
                'label' => 'Видео',
                'href' => route('videos.category', $category->slug)
            ];
        }

        if (TermCategory::where('name', $category->name)->first()) {
            $links[] = [
                'label' => 'Словарь',
                'href' => route('vocabulary.category', $category->slug)
            ];
        }

        return $links;
    }
}
