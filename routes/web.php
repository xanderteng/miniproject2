<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;

Route::controller(CarController::class)->group(function () {
    Route::get('/', 'index')->name('cars.index');        // Default route for index
    Route::get('/create-cars', 'create')->name('cars.create'); // Create car page
    Route::post('/create-cars', 'store');                // Store new car
    Route::get('/edit-cars/{car}', 'edit')->name('cars.edit'); // Edit car page
    Route::put('/edit-cars/{car}', 'update')->name('cars.update'); // Update car
    Route::delete('/delete-cars/{car}', 'destroy')->name('cars.destroy'); // Delete car
});
