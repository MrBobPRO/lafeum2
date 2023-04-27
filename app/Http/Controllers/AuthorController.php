<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Models\AuthorGroup;
use App\Models\Quote;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = $this->getAAuthorsList();

        return view('authors.index', compact('authors'));
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
    public function store(StoreAuthorRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $authors = $this->getAAuthorsList();

        switch ($slug) {
                // Case MOVIES
            case AuthorGroup::MOVIES_GROUP_SLUG:
                $author = new Author([
                    'name' => AuthorGroup::MOVIES_GROUP_NAME,
                    'biography' => AuthorGroup::MOVIES_GROUP_BIOGRAPHY
                ]);

                $movieIds = Author::movies()->orderBy('name')->pluck('id');

                $quotes = Quote::whereIn('author_id', $movieIds)
                    ->with(
                        'categories:id,name,slug',
                        'author:id,name,slug'
                    )
                    ->published('desc')
                    ->paginate(20);
                break;

                // CASE PROVERBS
            case AuthorGroup::PROVERBS_GROUP_SLUG:
                $author = new Author([
                    'name' => AuthorGroup::PROVERBS_GROUP_NAME,
                    'biography' => AuthorGroup::PROVERBS_GROUP_BIOGRAPHY,
                ]);

                $proverbIds = Author::proverbs()->orderBy('name')->pluck('id');

                $quotes = Quote::whereIn('author_id', $proverbIds)
                    ->with(
                        'categories:id,name,slug',
                        'author:id,name,slug'
                    )
                    ->published('desc')
                    ->paginate(20);
                break;

                // CASE PERSONS
            default:
                $author = Author::where('slug', $slug)->firstOrFail();

                $quotes = $author->quotes()->with([
                    'author:id,name,slug',
                    'categories:id,name,slug'
                ])
                    ->published('desc')
                    ->paginate(20);
                break;
        }

        return view('authors.show', compact('author', 'authors', 'quotes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAuthorRequest $request, Author $author)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        //
    }

    private function getAAuthorsList()
    {
        $authors = Author::persons()
            ->orderBy('name', 'asc')
            ->get();

        $authors->prepend(new Author([
            'name' => AuthorGroup::PROVERBS_GROUP_NAME,
            'slug' => AuthorGroup::PROVERBS_GROUP_SLUG
        ]));

        $authors->prepend(new Author([
            'name' => AuthorGroup::MOVIES_GROUP_NAME,
            'slug' => AuthorGroup::MOVIES_GROUP_SLUG,
        ]));

        return $authors;
    }
}
