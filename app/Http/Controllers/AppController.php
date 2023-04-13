<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Knowledge;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }
}
