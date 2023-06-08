<?php

namespace App\Models;

use App\Support\Traits\Favoritable;
use App\Support\Traits\Likeable;
use App\Support\Traits\Publishable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quote extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Favoritable;
    use Publishable;
    use Likeable;

    protected $guarded = ['id'];
    public static $tag = 'quotes'; // used only in dashboard

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function categories()
    {
        return $this->belongsToMany(QuoteCategory::class, 'category_quote', 'quote_id', 'category_id');
    }

    protected static function booted(): void
    {
        static::forceDeleting(function ($item) {
            $item->categories()->detach();
        });
    }
}
