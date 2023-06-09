<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Knowledge extends Model
{
    use HasFactory;
    use NodeTrait;

    public $timestamps = false;
    protected $guarded = ['id'];
    public static $tag = 'knowledge';

    public function terms()
    {
        return $this->belongsToMany(Term::class);
    }

    protected static function booted(): void
    {
        static::deleting(function ($item) {
            $item->terms()->detach();
        });
    }
}
