<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveController;
use App\Models\LeaveMaster;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DropdownController;

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

Auth::routes();

Route::get('/countries', [DropdownController::class, 'index']);
Route::get('/states/{id}', [DropdownController::class, 'getStates']);
Route::get('/cities/{id}', [DropdownController::class, 'getCities']);
Route::post('/submit-leave-request', [EmployeeController::class, 'storeLeave'])->name('submitLeaveRequest');
Route::get('/leave-request', [App\Http\Controllers\HomeController::class, 'leaveRequest'])->name('leaveRequest');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
