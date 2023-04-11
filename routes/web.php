<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ChannelController;
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

Route::controller(AppController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get("/about-us", 'aboutUs')->name('aboutUs');
    Route::get("/privacy-policy", 'privacy')->name('privacy');
    Route::get("/terms-of-use", 'termsOfUse')->name('termsOfUse');
    Route::get("/contacts", 'contacts')->name('contacts');
});

Route::controller(KnowledgeController::class)->name('knowledge.')->group(function () {
    Route::get('/knowledge', 'index')->name('index');
    Route::get('/knowledge/{knowledge:slug}', 'show')->name('show');
});

Route::controller(VocabularyController::class)->name('vocabulary.')->group(function () {
    Route::get('/vocabulary', 'index')->name('index');
    Route::get('/vocabulary/{category}', 'category')->name('category');
});

Route::controller(QuoteController::class)->name('quotes.')->group(function () {
    Route::get('/quotes', 'index')->name('index');
    Route::get('/quote/{quote}', 'show')->name('show');
    Route::get('/quotes/{category}', 'category')->name('category');
});

Route::controller(AuthorController::class)->name('authors.')->group(function () {
    Route::get('/authors', 'index')->name('index');
    Route::get('/authors/{author:slug}', 'show')->name('show');
});

Route::controller(VideoController::class)->name('videos.')->group(function () {
    Route::get('/videos', 'index')->name('index');
    Route::get('/video/{video}', 'show')->name('show');
    Route::get('/videos/{category}', 'category')->name('category');
});

Route::controller(ChannelController::class)->name('channels.')->group(function () {
    Route::get('/channels', 'index')->name('index');
    Route::get('/channels/{channel:slug}', 'show')->name('show');
});

Route::controller(TermController::class)->name('terms.')->group(function () {
    Route::get('/terms', 'index')->name('index');
    Route::get('/term/{term}', 'show')->name('show');
    Route::get('/terms/{category}', 'category')->name('category');
});

Route::controller(PhotoController::class)->name('photos.')->group(function () {
    Route::get('/photos', 'index')->name('index');
});

Route::controller(FeedbackController::class)->name('feedbacks.')->group(function () {
    Route::post('/feedback', 'store')->name('store');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
