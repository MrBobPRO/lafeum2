<?php

namespace App\Http\Controllers;

use App\Models\QuoteCategory;
use App\Models\TermCategory;
use App\Models\VideoCategory;
use Illuminate\Http\Request;
use Kalnoy\Nestedset\Collection;

class AppController extends Controller
{
    public function home()
    {
        // Join all categories
        $categories = new Collection();
        $categories = $categories->concat(QuoteCategory::get()->toTree());
        $categories = $categories->concat(TermCategory::get()->toTree());
        $categories = $categories->concat(VideoCategory::get()->toTree());
        $categories = $categories->unique('name');

        // Add supported types
        $categories->each(function ($item) {
            $item->supportedTypeLinks = $this->getSupportedTypeLinks($item);

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

    public function policy()
    {
        return view('pages.policy');
    }

    public function termsOfUse()
    {
        return view('pages.terms-of-use');
    }

    public function contacts()
    {
        return view('pages.contacts');
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
