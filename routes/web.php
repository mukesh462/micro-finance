<?php

use Illuminate\Support\Facades\Route;
use App\Admin\Controllers\IndexController;
use App\Jobs\ProcessPodcast;
use App\Livewire\LoanDisbrusment;
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
    dispatch(new ProcessPodcast());
    return view('welcome');
});

Route::get('/get-data', [IndexController::class, 'getData'])->name('get.data');
Route::get('/checkIndex', [IndexController::class, 'checkIndex'])->name('checkIndex');
Route::get('/get-employee', [IndexController::class, 'getemployee'])->name('get.employee');
Route::get('/get-member', [IndexController::class, 'getmember'])->name('get.member');
Route::get('/get-product', [IndexController::class, 'getproduct'])->name('get.product');
Route::get('/admin/per', TaskManager::class);
