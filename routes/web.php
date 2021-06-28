<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Category Routes
|--------------------------------------------------------------------------
|
| All Category Related Routes are here
|
 */
Route::middleware( ['auth:sanctum', 'verified'] )->name( 'category.' )->prefix( 'category' )->group( function () {
    Route::get( 'all', [CategoryController::class, 'index'] )->name( 'all' );
    Route::get( 'trashed', [CategoryController::class, 'trashes'] )->name( 'trashed' );
    Route::get( 'add', [CategoryController::class, 'create'] )->name( 'create' );
    Route::post( 'create', [CategoryController::class, 'store'] )->name( 'store' );
    Route::get( 'edit/{id}', [CategoryController::class, 'edit'] )->name( 'edit' );
    Route::post( 'update/{id}', [CategoryController::class, 'update'] )->name( 'update' );
    Route::post( 'delete/{id}', [CategoryController::class, 'delete'] )->name( 'delete' );
    Route::post( 'restore/{id}', [CategoryController::class, 'restore'] )->name( 'restore' );
    Route::post( 'destroy/{id}', [CategoryController::class, 'destroy'] )->name( 'destroy' );
} );


/*
|--------------------------------------------------------------------------
| Brand Routes
|--------------------------------------------------------------------------
|
| All Brand Related Routes are here
|
 */
Route::middleware( ['auth:sanctum', 'verified'] )->name( 'brand.' )->prefix( 'brand' )->group( function () {
    Route::get( 'all', [BrandController::class, 'index'] )->name( 'all' );
    Route::get( 'add', [BrandController::class, 'create'] )->name( 'create' );
    Route::post( 'create', [BrandController::class, 'store'] )->name( 'store' );
    Route::get( 'edit/{id}', [BrandController::class, 'edit'] )->name( 'edit' );
    Route::post( 'update/{id}', [BrandController::class, 'update'] )->name( 'update' );
    Route::post( 'delete/{id}', [BrandController::class, 'delete'] )->name( 'delete' );
} );

Route::middleware( ['auth:sanctum', 'verified'] )->get( '/dashboard', function () {
    $users = User::all();
    return view( 'dashboard', [
        'users' => $users,
    ] );
} )->name( 'dashboard' );

Route::get('/', function () {
    return view('welcome');
});