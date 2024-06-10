<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// controller
use App\Http\Controllers\Api\User\UserController as C_User;



Route::group(['prefix'=>"user"],function(){
    Route::get('/',[C_user::class,'search_user']);
    Route::post('/create',[C_user::class,'create_user']);
    Route::put('/detail',[C_user::class,'detail_user']);
    Route::delete('/delete',[C_user::class,'delete_user']);
});
