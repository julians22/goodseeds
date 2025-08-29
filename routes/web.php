<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
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
    Route::get('what-we-do', [HomeController::class, 'whatWeDo'])->name('what-we-do');
    Route::get('success-stories', [HomeController::class, 'successStories'])->name('success-stories');
    Route::get('article', [HomeController::class, 'article'])->name('article');
    Route::post('secure-contact', [ContactController::class, 'store'])->name('secure-contact');
    // Define your localized routes here
});
