<?php

namespace App\Providers;

use App\Models\DailyPost;
use App\Support\Helpers\Helper;
use Illuminate\Support\Facades\Route;
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

        View::composer(['components.quote-card', 'components.term-card', 'components.video-card'], function ($view) {
            $view->with('currentUser', auth()->user());

            if(auth()->user()) {
                $view->with('userFolders', auth()->user()->rootFolders);
            }
        });

        View::composer('layouts.profile-leftbar', function ($view) {
            $user = request()->user()->load('rootFolders');

            $view->with('user', $user)
                ->with('routeName', Route::currentRouteName());
        });

        View::composer('pages.profile', function ($view) {
            $view->with('user', request()->user());
        });

        View::composer('dashboard.*', function ($view) {
            $view->with('routeName', Route::currentRouteName())
                ->with('modelTag', Helper::getModelTag());;
        });
    }
}
