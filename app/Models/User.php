<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function isAdmin()
    {
        return $this->role->name == Role::ADMINISTRATOR_ROLE ? true : false;
    }

    public function folders()
    {
        return $this->hasMany(Folder::class)->orderBy('name', 'asc');
    }

    public function rootFolders()
    {
        return $this->hasMany(Folder::class)->whereNull('parent_id')->orderBy('name', 'asc');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function getFoldersItems($folderID)
    {
        $favorites = $this->favorites()->where('folder_id', $folderID)->latest()->get();
        $items = new Collection();

        foreach($favorites as $item) {
            $instance = $item->favoritable;
            $items->push($instance);
        }

        return $items;
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function getLikedItems()
    {
        $likes = $this->likes;
        $items = new Collection();

        foreach($likes as $item) {
            $instance = $item->likeable;
            $items->push($instance);
        }

        return $items;
    }

    // public function favoriteQuotes()
    // {
    //     return $this->belongsToMany(Quote::class, 'favorites', 'user_id', 'favoritable_id')
    //         ->where('favoritable_type', Quote::class);
    // }

    // public function favoriteTerms()
    // {
    //     return $this->belongsToMany(Term::class, 'favorites', 'user_id', 'favoritable_id')
    //         ->where('favoritable_type', Term::class);
    // }

    // public function favoriteVideos()
    // {
    //     return $this->belongsToMany(Video::class, 'favorites', 'user_id', 'favoritable_id')
    //         ->where('favoritable_type', Video::class);
    // }
}
