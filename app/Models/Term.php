<?php

namespace App\Models;

use App\Support\Traits\Favoritable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Term extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Favoritable;

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
            ->where('show_in_vocabulary', true)
            ->orderBy('name');
    }
}
