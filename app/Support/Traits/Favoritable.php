<?php

namespace App\Support\Traits;

use App\Models\Favorite;
use App\Models\User;

trait Favoritable
{
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favoritable');
    }

    public function favoritedBy(User $user)
    {
        return $this->favorites->contains('user_id', $user->id);
    }
}
