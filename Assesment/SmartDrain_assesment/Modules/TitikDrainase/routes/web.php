<?php

use Illuminate\Support\Facades\Route;
use Modules\TitikDrainase\Http\Controllers\TitikDrainaseController;

Route::middleware('auth')->group(function () {
    Route::resource('titikdrainases', TitikDrainaseController::class)->names('titikdrainase');
    Route::get('titikdrainase', [TitikDrainaseController::class, 'index'])
        ->middleware('role:admin,user')
        ->name('titikdrainase.index');

    Route::middleware('role:admin')->group(function () {
        Route::get('titikdrainase/create', [TitikDrainaseController::class, 'create'])->name('titikdrainase.create');
        Route::post('titikdrainase', [TitikDrainaseController::class, 'store'])->name('titikdrainase.store');
        Route::get('titikdrainase/{titikdrainase}/edit', [TitikDrainaseController::class, 'edit'])->name('titikdrainase.edit');
        Route::put('titikdrainase/{titikdrainase}', [TitikDrainaseController::class, 'update'])->name('titikdrainase.update');
        Route::delete('buku/{buku}', [TitikDrainaseController::class, 'destroy'])->name('titikdrainase.destroy');

    });

});



   
   