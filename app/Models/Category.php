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
        return $this->belongsToMany(Quote::class);
    }

    public function terms()
    {
        return $this->belongsToMany(Term::class);
    }

    public function videos()
    {
        return $this->belongsToMany(Video::class);
    }
}
