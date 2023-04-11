<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }

    public function authorGroup()
    {
        return $this->belongsTo(AuthorGroup::class);
    }

    public function scopePersons($query)
    {
        return $query->where('author_group_id', AuthorGroup::where('name', AuthorGroup::PERSONS_GROUP_NAME)->first()->id);
    }

    public function scopeMovies($query)
    {
        return $query->where('author_group_id', AuthorGroup::where('name', AuthorGroup::MOVIES_GROUP_NAME)->first()->id);
    }

    public function scopeProverbs($query)
    {
        return $query->where('author_group_id', AuthorGroup::where('name', AuthorGroup::PROVERBS_GROUP_NAME)->first()->id);
    }
}
