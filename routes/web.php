<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Route\Guest\GuestController as C_Guest;
use App\Http\Controllers\Route\Admin\AdminController as C_Admin;
use App\Http\Controllers\Route\Admin\User\userController as C_U_Admin;
use App\Http\Controllers\Route\Admin\Role\RoleController as C_R_Admin;
use App\Http\Controllers\Route\Admin\Minta_bakat\MinatController as C_M_Admin;

Route::get('/developer',function (){
    return view('Admin.Settings.User.dashboard');
});

Route::get('/',[C_Guest::class,'guest_page'])->name('login.page');
Route::post('/',[C_Guest::class,'login'])->name('login.send');

Route::group(['prefix' => 'admin','middelware'=> 'auth:sanctum'],function(){
    Route::get('/',[C_Admin::class,'dashboard'])->name('admin.dashboard');
    Route::group(['prefix' => 'minat_bakat'],function(){
        Route::get('/',[C_M_Admin::class,'user_test'])->name('admin.minat.dashboard');
        Route::group(['prefix' => 'setting_page'],function(){
            Route::get('/',[C_M_Admin::class,'setting_page'])->name('admin.minat.setting.dashboard');
            Route::get('/create',[C_M_Admin::class,'page_create_soal'])->name('admin.minat.setting.soal.create');
            Route::post('/create',[C_M_Admin::class,'create_soal'])->name('admin.minat.setting.soal.send');
            Route::post('/delete',[C_M_Admin::class,'delete_soal'])->name('admin.minat.setting.soal.delete');
            Route::post('/edit',[C_M_Admin::class,'edit_soal'])->name('admin.minat.setting.soal.edit');
            Route::post('/description',[C_M_Admin::class,'edit_description'])->name('admin.minat.setting.description');
        });
    });
    Route::group((['prefix'=>'user']),function(){
        Route::get('/',[C_U_Admin::class,'dashboard'])->name('admin.user.dashboard');
        Route::post('/create',[C_U_Admin::class,'create_user'])->name('admin.user.create');
        Route::post('/delete',[C_U_Admin::class,'delete_user'])->name('admin.user.delete');
    });
    Route::group((['prefix'=>'Role']),function(){
        Route::get('/',[C_R_Admin::class,'dashboard'])->name('admin.role.dashboard');
        Route::get('/permission',[C_R_Admin::class,'permission'])->name('admin.role.permission');
        Route::post('/create',[C_R_Admin::class,'create'])->name('admin.role.create');
    });
});


