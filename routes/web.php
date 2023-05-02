<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\KnowledgeController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\VocabularyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware('verified')->group(function () {
    Route::controller(AppController::class)->group(function () {
        Route::get('/', 'home')->name('home')->middleware('verified');
        Route::get("/about-us", 'aboutUs')->name('about-us');
        Route::get("/contacts", 'contacts')->name('contacts');
        Route::get("/privacy-policy", 'policy')->name('policy');
        Route::get("/terms-of-use", 'termsOfUse')->name('terms-of-use');
    });

    Route::controller(KnowledgeController::class)->name('knowledge.')->group(function () {
        Route::get('/knowledge', 'index')->name('index');
        Route::get('/knowledge/{knowledge:slug}', 'show')->name('show');
    });

    Route::controller(VocabularyController::class)->name('vocabulary.')->group(function () {
        Route::get('/vocabulary', 'index')->name('index');
        Route::get('/vocabulary/{category:slug}', 'category')->name('category');
        Route::get('/vocabulary/body/{term}', 'getBody')->name('get-body'); // used in AJAX search
        Route::post('/vocabulary/search', 'search')->name('search');
    });

    Route::controller(QuoteController::class)->name('quotes.')->group(function () {
        Route::get('/quotes', 'index')->name('index');
        Route::get('/quote/{quote}', 'show')->name('show');
        Route::get('/quotes/{category:slug}', 'category')->name('category');
    });

    Route::controller(AuthorController::class)->name('authors.')->group(function () {
        Route::get('/authors', 'index')->name('index');
        Route::get('/authors/{slug}', 'show')->name('show');
    });

    Route::controller(VideoController::class)->name('videos.')->group(function () {
        Route::get('/videos', 'index')->name('index');
        Route::get('/video/{video}', 'show')->name('show');
        Route::get('/videos/{category:slug}', 'category')->name('category');
    });

    Route::controller(ChannelController::class)->name('channels.')->group(function () {
        Route::get('/channels', 'index')->name('index');
        Route::get('/channels/{channel:slug}', 'show')->name('show');
    });

    Route::controller(TermController::class)->name('terms.')->group(function () {
        Route::get('/terms', 'index')->name('index');
        Route::get('/term/{term}', 'show')->name('show');
        Route::get('/terms/{category:slug}', 'category')->name('category');
    });

    Route::controller(PhotoController::class)->name('photos.')->group(function () {
        Route::get('/photos', 'index')->name('index');
    });

    Route::controller(FeedbackController::class)->name('feedback.')->group(function () {
        Route::post('/feedback', 'store')->name('store');
    });

    Route::controller(FavoriteController::class)->name('favorites.')->group(function () {
        Route::get('/favorite-quotes', 'quotes')->name('quotes');
        Route::get('/favorite-terms', 'terms')->name('terms');
        Route::get('/favorite-videos', 'videos')->name('videos');
        Route::post('/toggle-favorites', 'toggle')->name('toggle');
    });

    Route::controller(ProfileController::class)->name('profile.')->middleware('auth')->group(function () {
        Route::get('/profile', 'edit')->name('edit');
        Route::patch('/profile', 'update')->name('update');
        Route::delete('/profile', 'destroy')->name('destroy');
    });
});


Route::get('/dashboard', function () {
    return 'dashboard';
})->name('dashboard');

require __DIR__.'/auth.php';
