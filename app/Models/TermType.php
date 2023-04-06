<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermType extends Model
{
    use HasFactory;

    public $timestamp = false;

    const SCIENTIFIC_TERMS = 'Термины научного мира';
    const EXPERT_COMMENTS = 'Комментарии специалистов';

    public function terms()
    {
        return $this->hasMany(Term::class);
    }
}
