<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ShiftController;
use App\Http\Controllers\Api\DepartmentsController;
use App\Http\Controllers\Api\CarouselItemsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

    Route::post('/login', [Authcontroller::class, 'login'])->name('user.login');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');



Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('user.logout');
    
    Route::controller(UserController::class)->group(function () {
        Route::get('/user',                     'index');
        Route::get('/user/{id}',                'show');
        Route::put('/user/{id}',                'update')->name('user.update');
        Route::put('/user/email/{id}',          'email')->name('user.email');
        Route::put('/user/password/{id}',       'password')->name('user.password');
        Route::delete('/user/{id}',             'destroy');
    });

    Route::controller(DepartmentsController::class)->group(function () {
        Route::get('/department',               'index');
        Route::get('/department/{id}',          'show');
        Route::post('/department',              'store');
        Route::put('/department/{id}',          'update');
        Route::delete('/department/{id}',       'destroy');
    });
    
});

    Route::controller(ShiftController::class)->group(function () {
        Route::get('/shift',                    'index');
        Route::get('/shift/{id}',               'show');
        Route::post('/shift',                   'store');
        Route::put('/shift/{id}',               'update');
        Route::delete('/shift/{id}',            'destroy');
    });
    




// Route::controller(CarouselItemsController::class)->group(function () {
//     Route::get('/carousel',         'index');
//     Route::get('/carousel/{id}',    'show');
//     Route::post('/carousel',        'store');
//     Route::put('/carousel/{id}',    'update');
//     Route::delete('/carousel/{id}', 'destroy');
// });
