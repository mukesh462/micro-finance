<?php

use Illuminate\Support\Facades\Route;
use App\Admin\Controllers\IndexController;
use App\Livewire\TaskManager;

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
    return view('welcome');
});

Route::get('/get-data', [IndexController::class, 'getData'])->name('get.data');
Route::get('/get-employee', [IndexController::class, 'getemployee'])->name('get.employee');
Route::get('/get-product', [IndexController::class, 'getproduct'])->name('get.product');
Route::get('/admin/per', TaskManager::class);