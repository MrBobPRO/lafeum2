<?php

namespace App\Providers;

use App\Models\DailyPost;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.rightbar', function ($view) {
            $view->with('todaysPost', DailyPost::orderBy('date', 'desc')->with(['quote', 'term', 'video', 'photo'])->first());
        });
    }
}
