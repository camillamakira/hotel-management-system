<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RecreationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServiceController;

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
    return view('index');
});

Route::get('about', [PagesController::class, 'about']);
Route::get('rooms', [PagesController::class, 'rooms']);
Route::get('foods', [PagesController::class, 'foods']);
Route::get('recreation', [PagesController::class, 'recreation']);
Route::get('singleroom/{id}', [PagesController::class, 'singleRoom']);
Route::get('singlefood/{id}', [PagesController::class, 'singleFood']);
Route::get('singlerecreation/{id}', [PagesController::class, 'singleRecreation']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('admin_dashboard', [App\Http\Controllers\Admin\AdminController::class, 'index'])->middleware('role:admin');
Route::get('manager_dashboard', [App\Http\Controllers\Manager\ManagerController::class, 'index'])->middleware('role:manager');
Route::get('user_dashboard', [App\Http\Controllers\User\UserController::class, 'index'])->middleware('role:user');

 //food
Route::get('food-datatable', [FoodController::class, 'index']);
Route::post('store-food', [FoodController::class, 'store']);
Route::post('edit-food', [FoodController::class, 'edit']);
Route::post('delete-food', [FoodController::class, 'destroy']);

//room
Route::get('room-datatable', [RoomController::class, 'index']);
Route::post('store-room', [RoomController::class, 'store']);
Route::post('edit-room', [RoomController::class, 'edit']);
Route::post('delete-room', [RoomController::class, 'destroy']);

//recreation
Route::get('recreation-datatable', [RecreationController::class, 'index']);
Route::post('store-recreation', [RecreationController::class, 'store']);
Route::post('edit-recreation', [RecreationController::class, 'edit']);
Route::post('delete-recreation', [RecreationController::class, 'destroy']);

//user
Route::get('user-datatable', [UserController::class, 'index']);
Route::post('store-user', [UserController::class, 'store']);
Route::post('edit-user', [UserController::class, 'edit']);
Route::post('delete-user', [UserController::class, 'destroy']);

//about
Route::get('about-datatable', [AboutController::class, 'index']);
Route::post('store-about', [AboutController::class, 'store']);
Route::post('edit-about', [AboutController::class, 'edit']);
Route::post('delete-about', [AboutController::class, 'destroy']);

//service
Route::get('service-datatable', [ServiceController::class, 'index']);
Route::post('store-service', [ServiceController::class, 'store']);
Route::post('edit-service', [ServiceController::class, 'edit']);
Route::post('delete-service', [ServiceController::class, 'destroy']);