<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('property.propertylist');
// });

Route::post('/propriedade/salvar',[PropertyController::class, 'store'])->name('property.store');
Route::get('/lista/Property',[PropertyController::class, 'index'])->name('property.index');
Route::get('/propriedade/formulario',[PropertyController::class, 'create'])->name('property.create');
Route::any('/propriedade/delete/{id}',[PropertyController::class, 'destroy'])->name('property.delete');
Route::get('/propriedade/edit/{id}',[PropertyController::class, 'edit'])->name('property.edit');
Route::put('/propriedade/update/{id}',[PropertyController::class, 'update'])->name('property.update');

Route::get('/Category/formulario',[CategoryController::class, 'create'])->name('category.create');
Route::get('/Category/lista',[CategoryController::class, 'index'])->name('category.index');
Route::post('/Category/salvar',[CategoryController::class, 'store'])->name('category.store');
Route::put('/Category/alterar/{id}',[CategoryController::class, 'update'])->name('category.update');
Route::get('/Category/edit/{id}',[CategoryController::class, 'edit'])->name('category.edit');
Route::delete('/Category/delete/{id}',[CategoryController::class, 'destroy'])->name('category.delete');

