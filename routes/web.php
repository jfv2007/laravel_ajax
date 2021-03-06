<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TtagController;
use App\Http\Controllers\Tag18Controller;

use App\Models\Employee;
use App\Models\Ttags;

use Illuminate\Support\Facades\Route;

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

Route::get('/employee', [EmployeeController::class, 'index'])->name('employee');
Route::post('employee/store', [EmployeeController::class, 'store'])->name('store.employee');
Route::get('employee/fetchall', [EmployeeController::class, 'fetchAll'])->name('fetchAll.employee');
Route::delete('employee/delete', [EmployeeController::class, 'delete'])->name('delete.employee');
Route::get('employee/edit', [EmployeeController::class, 'edit'])->name('edit.employee');
Route::post('employee/update', [EmployeeController::class, 'update'])->name('update.employee');



Route::get('/tags',[TtagController::class, 'index'])->name('tags');
Route::post('tags/store',[TtagController::class, 'store'])->name('store.tags');
Route::get('tags/fetchall', [TtagController::class, 'fetchAll'])->name('fetchAll.tags');
Route::delete('tags/delete', [TtagController::class, 'delete'])->name('delete.tags');
Route::get('tags/edit', [TtagController::class, 'edit'])->name('edit.tags');
Route::post('tags/update', [TtagController::class, 'update'])->name('update.tags');

//de esta forma no funciona
//Route::resource('tags','App\Http\Controllers\TtagController');

Route::get('/tag18', [Tag18Controller::class, 'index'])->name('tag18');
Route::post('tag18/store', [Tag18Controller::class, 'store'])->name('store.tag18');
Route::get('tag18/fetchall', [Tag18Controller::class, 'fetchAll'])->name('fetchAll.tag18');
Route::delete('tag18/delete', [Tag18Controller::class, 'delete'])->name('delete.tag18');
Route::get('tag18/edit', [Tag18Controller::class, 'edit'])->name('edit.tag18');
Route::post('tag18/update', [Tag18Controller::class, 'update'])->name('update.tag18');
