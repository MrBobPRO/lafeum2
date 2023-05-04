<?php

namespace App\Models;

use App\Support\Traits\Favoritable;
use App\Support\Traits\Publishable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\View;

class Term extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Favoritable;
    use Publishable;

    protected $guarded = ['id'];

    public function categories()
    {
        return $this->belongsToMany(TermCategory::class, 'category_term', 'term_id', 'category_id');
    }

    public function knowledge()
    {
        return $this->belongsToMany(Knowledge::class);
    }

    public function termType()
    {
        return $this->belongsTo(TermType::class);
    }

    public function scopeVocabulary($query)
    {
        return $query->where('name', '!=', '')
            ->where('show_in_vocabulary', true);
    }

    public function getSubtermsAttribute()
    {
        // get all links
        preg_match_all('/https?:\/\/(www\.)?lafeum\.ru[^\s]*/', $this->body, $links);

        // extract all ids from links path https://domain.com/term/{id}
        $ids = array();

        foreach($links[0] as $link) {
            $parsed = parse_url($link);
            $ids[] = substr($parsed['path'], 6);
        }

        $subterms = Term::whereIn('id', $ids)->select('id', 'body')->get();

        return View::make('components.subterms', compact('subterms'))->render();
    }

}
