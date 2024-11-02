<?php

use App\Http\Controllers\MyItemsController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Models\Item;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    if (\Auth::user()->is_admin) {
        $items = Item::all();
        return view('dashboard', compact('items'));
    } else {
        return redirect('/');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/user/items', [MyItemsController::class, 'showItems'])->name('my-items')->middleware('auth');
Route::post('/items/{id}/toggle-status', [ItemController::class, 'toggleStatus'])->name('items.toggleStatus');

Route::resource('items', ItemController::class);
