<?php

use App\Livewire\Expense;
use App\Livewire\Home;
use App\Livewire\Login;
use App\Livewire\Presence;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function (){
    Route::get('/login', Login::class)->name('login');
});

Route::middleware('auth')->group(function (){
    Route::get('/', Home::class)->name('home');
    Route::get('/kehadiran', Presence::class)->name('presence.create');
    Route::get('/pengeluaran', Expense::class)->name('expense.create');
});
