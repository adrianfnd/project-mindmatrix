<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Route\User\UserController as C_User;

Route::group(['middleware' => ['auth', 'Role:user']], function () {
    Route::get('/',[C_User::class,'dashboard'])->name('dashboard');
});
?>