<?php

namespace App\Models;

use App\Support\Traits\Favoritable;
use App\Support\Traits\Publishable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Publishable;

    protected $guarded = ['id'];
}
