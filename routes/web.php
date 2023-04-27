<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Guest\HomeController as GuestHomeController;
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

Route::get('/', [GuestHomeController::class, 'index']);

Route::get('/home', [CardController::class, 'index'])->middleware('auth')->name('home');

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function (){
        Route::get('/cards/trash',[CardController::class, 'trash'])->name('cards.trash');
        Route::put('/cards/{card}/restore',[CardController::class, 'restore'])->name('cards.restore');
        Route::delete('/cards/{card}/force-delete',[CardController::class, 'forceDelete'])->name('cards.force-delete');
        
        Route::resource('cards', CardController::class);
        
        Route::resource('categories', CategoryController::class)->except(['show']);
    });


Route::middleware('auth')
    ->prefix('profile') //Tutti gli URL hanno il prefisso /profile
    ->name('profile.')  // Tutti i nomi delle rotte hanno il prefisso profile.
    ->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
});

require __DIR__.'/auth.php';