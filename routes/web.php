<?php

use App\Http\Controllers\ShortenerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/links/{link}', [ShortenerController::class, 'show'])->name('link.shorten');
Route::post('/links/generate', [ShortenerController::class, 'store'])->name('link.generate');
Route::get('/', [ShortenerController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function () {
    Route::get('logout', function () {
        auth()->logout();
        return redirect()->route('home');
    })->name('logout');
});
