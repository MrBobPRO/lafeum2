<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Quote;
use App\Models\Term;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class AppController extends Controller
{
    public function home()
    {
        $categories = Category::orderBy('_lft')->get()->each(function ($item) {
            $supportedTypes = Category::where('name', $item->name)
                ->orderBy('_lft')
                ->get('type')
                ->pluck('type');
            $item->links = $this->getCategoryLinks($item, $supportedTypes);
        })->toTree()->unique('name');

        return view('pages.home', compact('categories'));
    }

    public function aboutUs()
    {
        return view('pages.about-us');
    }

    private function getCategoryLinks(Category $category, Collection $supportedTypes)
    {
        $links = [];

        if ($supportedTypes->contains(Quote::class)) {
            $links[] = [
                'label' => 'Цитаты и Афоризмы',
                'href' => route('quotes.category', $category->slug)
            ];
        }

        if ($supportedTypes->contains(Term::class)) {
            $links[] = [
                'label' => 'Термины',
                'href' => route('terms.category', $category->slug)
            ];
        }

        if ($supportedTypes->contains(Video::class)) {
            $links[] = [
                'label' => 'Видео',
                'href' => route('videos.category', $category->slug)
            ];
        }

        if ($supportedTypes->contains(Term::class)) {
            $links[] = [
                'label' => 'Словарь',
                'href' => route('vocabulary.category', $category->slug)
            ];
        }

        return $links;
    }
}
