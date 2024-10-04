<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ShiftController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\DepartmentsController;
use App\Http\Controllers\Api\CarouselItemsController;
use App\Http\Controllers\Api\AttendanceRecordController;
use App\Models\AttendanceRecord;

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
Route::post('/admin', [Authcontroller::class, 'admin'])->name('admin.login');

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/logout', [AuthController::class, 'logout'])->name('user.logout');


    // Admin APIs
        Route::controller(UserController::class)->group(function () {
        Route::get('/user',                     'index');
        Route::get('/user/{id}',                'show');
        Route::post('/user',                    'store')->name('user.store');
        Route::put('/user/{id}',                'update')->name('user.update');
        Route::put('/user/email/{id}',          'email')->name('user.email');
        Route::put('/user/password/{id}',       'password')->name('user.password');
        Route::put('/user/image/{id}',          'image')->name('user.image');
        Route::delete('/user/{id}',             'destroy');
    });

    Route::controller(AttendanceRecordController::class)->group(function () {
        Route::get('/attendance',               'index');
        Route::post('/attendance',              'store')->name('attendance.store');
        Route::get('/attendance/{id}',          'show');
        Route::put('/attendance/{id}',          'update')->name('attendance.update');
    });

    Route::controller(DepartmentsController::class)->group(function () {
        Route::get('/department',               'index');
        Route::get('/department/{id}',          'show');
        Route::post('/department',              'store');
        Route::put('/department/{id}',          'update');
        Route::delete('/department/{id}',       'destroy');
    });

    Route::controller(ShiftController::class)->group(function () {
        Route::get('/shift',                    'index');
        Route::get('/shift/{id}',               'show');
        Route::post('/shift',                   'store');
        Route::put('/shift/{id}',               'update');
        Route::delete('/shift/{id}',            'destroy');
    });


    // User Specific APIs
    Route::get('/profile/show',             [ProfileController::class, 'show']);
    Route::put('/profile/image',            [ProfileController::class, 'image'])->name('profile.image');

});


// Route::controller(CarouselItemsController::class)->group(function () {
//     Route::get('/carousel',         'index');
//     Route::get('/carousel/{id}',    'show');
//     Route::post('/carousel',        'store');
//     Route::put('/carousel/{id}',    'update');
//     Route::delete('/carousel/{id}', 'destroy');
// });
