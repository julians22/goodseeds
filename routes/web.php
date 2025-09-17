<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
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



Route::localized(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get(__('routes.insight'), [HomeController::class, 'article'])->name('article');
    Route::get(__('routes.insight').'/{slug}', [HomeController::class, 'showArticle'])->name('insight-detail');

    Route::get(__('routes.success_story'), [HomeController::class, 'indexSuccessStory'])->name('success-story');
    Route::get(__('routes.success_story').'/{slug}', [HomeController::class, 'showSuccessStory'])->name('success-story-detail');

    Route::get(__('routes.what_we_do'), [HomeController::class, 'indexWhatWeDo'])->name('what-we-do');

    Route::post('secure-contact', [ContactController::class, 'store'])->name('secure-contact');
});