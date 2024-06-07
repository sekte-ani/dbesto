<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout.menuscreen');
});
Route::get('/login', function () {
    return view('layout.login');
});
Route::get('/kehadiran', function () {
    return view('layout.kehadiran');
});
Route::get('/pengeluaran', function () {
    return view('layout.pengeluaran');
});
Route::get('/menu', function () {
    return view('layout.menuscreen');
});
