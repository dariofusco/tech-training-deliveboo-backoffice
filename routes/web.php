<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\DishController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/restaurant/create', [RestaurantController::class, 'create'])->name('restaurant.create');
    Route::post('/restaurant/store', [RestaurantController::class, 'store'])->name('restaurant.store');
    Route::get('/restaurant', [RestaurantController::class, 'index'])->name('restaurant.index');
    Route::get('/restaurant/edit', [RestaurantController::class, 'edit'])->name('restaurant.edit');
    Route::put('/restaurant/update/{id}', [RestaurantController::class, 'update'])->name('restaurant.update');

    Route::get('/restaurant/dish/create', [DishController::class, 'create'])->name('dish.create');
    Route::post('/restaurant/dish/store', [DishController::class, 'store'])->name('dish.store');
    Route::get('/restaurant/dish', [DishController::class, 'index'])->name('dish.index');
    Route::get('/restaurant/dish/{id}/edit', [DishController::class, 'edit'])->name('dish.edit');
    Route::put('/restaurant/dish/{id}/update', [DishController::class, 'update'])->name('dish.update');
    Route::delete('/restaurant/dish/{id}/delete', [DishController::class, 'destroy'])->name('dish.delete');
});



require __DIR__ . '/auth.php';
