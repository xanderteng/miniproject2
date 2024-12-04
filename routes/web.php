<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailController;
use App\Http\Middleware\IsLogin;

Route::controller(CarController::class)->group(function () {
    Route::get('/', 'index')->name('cars.index');      
    Route::get('/create-cars', 'create')->name('cars.create'); 
    Route::post('/create-cars', 'store')->middleware(IsLogin::class);               
    Route::get('/edit-cars/{car}', 'edit')->name('cars.edit')->middleware(IsLogin::class); 
    Route::put('/edit-cars/{car}', 'update')->name('cars.update')->middleware(IsLogin::class);
    Route::delete('/delete-cars/{car}', 'destroy')->name('cars.destroy')->middleware(IsLogin::class);
});

Route::controller(AuthController::class)->group(function(){
    Route::get('/register', 'getRegister')->name('getRegister');
    Route::post('/register', 'register')->name('register');
    Route::get('/login', 'getLogin')->name('getLogin');
    Route::post('/login', 'login')->name('login');
    Route::post('/logout', 'logout')->name('logout');
});

Route::get('/send-email/{email}', [EmailController::class, 'sendEmail'])->name('sendEmail');
