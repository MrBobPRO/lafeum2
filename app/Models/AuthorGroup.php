<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorGroup extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name'];

    const PERSONS_GROUP_NAME = 'Автор';
    const MOVIES_GROUP_NAME = 'Фильмы и Сериалы';
    const PROVERBS_GROUP_NAME = 'Пословицы и поговорки';

    public function authors()
    {
        return $this->hasMany(Author::class);
    }
}
