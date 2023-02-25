<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('admin_dashboard', [App\Http\Controllers\Admin\AdminController::class, 'index'])->middleware('role:admin');
Route::get('manager_dashboard', [App\Http\Controllers\Manager\ManagerController::class, 'index'])->middleware('role:manager');
Route::get('user_dashboard', [App\Http\Controllers\User\UserController::class, 'index'])->middleware('role:user');

 
Route::get('food-datatable', [FoodController::class, 'index']);
Route::post('store-food', [FoodController::class, 'store']);
Route::post('edit-food', [FoodController::class, 'edit']);
Route::post('delete-food', [FoodController::class, 'destroy']);