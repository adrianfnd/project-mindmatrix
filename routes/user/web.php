<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Route\User\UserController as C_User;
use App\Http\Controllers\Route\User\Minat_bakat\minatController as C_U_MinatBakat;

Route::group(['middleware' => ['auth:sanctum', 'Role:user']], function () {
    Route::get('/',[C_User::class,'dashboard'])->name('dashboard');
    Route::get('/logout',[C_User::class,'user_logout'])->name('logout');
    Route::group(['prefix'=>'minat_bakat'],function(){
        Route::get('/',[C_U_MinatBakat::class,'dashboard'])->name('minat.dashboard');
    });
});
?>