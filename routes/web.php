<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdoptionsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PetsController;
use App\Http\Controllers\FormsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//USUÁRIO
Route::get('/', [AdoptionsController::class, 'index'])->name('index');
Route::get('/adocao', [AdoptionsController::class, 'adoption'])->name('adoption');
Route::get('/pet/{id}/{name}', [AdoptionsController::class, 'details'])->name('details');
Route::get('/pet/{name}', [AdoptionsController::class, 'form'])->name('form');
Route::post('/adocao', [AdoptionsController::class, 'store'])->name('store');


//LOGIN
Route::controller(LoginController::class)->group(function() {
    Route::get('/login', 'index')->name('login.index');
    Route::post('/login', 'store')->name('login.store');
    Route::delete('/login', 'destroy')->name('login.destroy');
});

//ADMIN USUÁRIOS
Route::get('/admin', [UsersController::class, 'index'])->name('admin.index');
Route::get('/cadastro', [UsersController::class, 'create'])->name('admin.create');
Route::post('/admin', [UsersController::class, 'store'])->name('admin.store');
Route::get('/{id}/edit', [UsersController::class, 'edit'])->name('admin.edit');
Route::put('/{id}', [UsersController::class, 'update'])->name('admin.update');
Route::delete('/admin/{id}', [UsersController::class, 'destroy'])->name('admin.destroy');

//ADMIN PETS
Route::get('/admin/pets', [PetsController::class, 'index'])->name('admin.pets.index');
Route::get('/admin/pets/cadastro', [PetsController::class, 'create'])->name('admin.pets.create');
Route::post('/admin/pets', [PetsController::class, 'store'])->name('admin.pets.store');
Route::get('/admin/pets/{id}/edit', [PetsController::class, 'edit'])->name('admin.pets.edit');
Route::put('/admin/pets/{id}', [PetsController::class, 'update'])->name('admin.pets.update');
Route::delete('/admin/pets/{id}', [PetsController::class, 'destroy'])->name('admin.pets.destroy');

//ADMIN FORMS
Route::get('/admin/forms', [FormsController::class, 'index'])->name('admin.forms.index');
Route::delete('/admin/forms/{id}', [FormsController::class, 'destroy'])->name('admin.forms.destroy');
Route::get('/admin/forms/download-csv', [FormsController::class, 'downloadCsv'])->name('download.csv');
Route::get('/admin/forms/download-pdf', [FormsController::class, 'downloadPdf'])->name('download.pdf');