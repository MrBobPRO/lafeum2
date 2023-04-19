<?php

namespace App\Support\Traits;

use Carbon\Carbon;

trait Publishable
{
    public function scopePublished($query, $sortType = null)
    {
        $query->where('publish_at', '<=', Carbon::now());

        if (!$sortType) {
            return $query;
        }

        return $query->orderBy('publish_at', $sortType);
    }
}
