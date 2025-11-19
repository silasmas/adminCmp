<?php

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
use App\Http\Controllers\TestimonyWallController;

Route::get('/temoignages', [TestimonyWallController::class, 'index'])->name('wall.index');
Route::post('/temoignages', [TestimonyWallController::class, 'store'])->name('wall.store');

Route::get('/temoignages/verifier', [TestimonyWallController::class, 'showVerifyForm'])->name('wall.verify.form');
Route::post('/temoignages/verifier', [TestimonyWallController::class, 'verify'])->name('wall.verify');
Route::get('/', function () {
    return redirect('/admin');
});
