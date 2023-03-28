<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('login',\App\Http\Livewire\Auth\Login::class)->name('login');

Route::middleware('auth:web')->group(function (){
    Route::get('home',\App\Http\Livewire\Home::class)->name('home');
    Route::get('expense',\App\Http\Livewire\Expense\Index::class)->name('expense');
});
