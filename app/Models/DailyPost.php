<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyPost extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = ['id'];

    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }

    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }
}
