<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'user_id'];
    protected $with = ['childs'];

    public function childs()
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}
