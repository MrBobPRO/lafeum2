<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

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

    public function childs()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function scopeParents($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeQuote($query)
    {
        return $query->where('type', Quote::class);
    }

    public function scopeTerm($query)
    {
        return $query->where('type', Term::class);
    }

    public function scopeVideo($query)
    {
        return $query->where('type', Video::class);
    }


}
