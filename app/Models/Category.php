<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use HasFactory;
    use NodeTrait;

    public $timestamps = false;
    protected $guarded = ['id'];

    public function quotes()
    {
        return $this->morphedByMany(Quote::class, 'categoriable');
    }

    public function terms()
    {
        return $this->morphedByMany(Term::class, 'categoriable');
    }

    public function video()
    {
        return $this->morphedByMany(Video::class, 'categoriable');
    }

    public function scopeQuoteType($query)
    {
        return $query->where('type', Quote::class);
    }

    public function scopeTermType($query)
    {
        return $query->where('type', Term::class);
    }

    public function scopeVideoType($query)
    {
        return $query->where('type', Video::class);
    }
}
