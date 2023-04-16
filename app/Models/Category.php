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
        return $this->hasMany(Quote::class);
    }

    public function terms()
    {
        return $this->hasMany(Term::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}
