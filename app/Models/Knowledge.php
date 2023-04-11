<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Knowledge extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function terms()
    {
        return $this->belongsToMany(Term::class);
    }
}
