<?php

use Illuminate\Support\Facades\Route;

// posisi route admin bisa di lihat di folder bootstrap app.php
// route admin di simpan di admin/web.php 
// Guest
use App\Http\Controllers\Route\Guest\GuestController as C_Guest;
use Illuminate\Support\Facades\Storage;

Route::get('/test',function (){
    return view('Admin.layouts.app');
});

Route::get('/developer',function (){
    return view('Admin.Settings.User.dashboard');
});

Route::get('/',[C_Guest::class,'guest_page'])->name('login.page');
Route::post('/',[C_Guest::class,'login'])->name('login');
Route::post('/send',[C_Guest::class,'send_soal_free'])->name('guest.send_free_course');

