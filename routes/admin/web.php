<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Route\Admin\AdminController as C_Admin;
use App\Http\Controllers\Route\Admin\User\userController as C_U_Admin;
use App\Http\Controllers\Route\Admin\Role\RoleController as C_R_Admin;
use App\Http\Controllers\Route\Admin\Minta_bakat\MinatController as C_M_Admin;


Route::group(['middleware' => ['auth:sanctum', 'Role:admin']], function () {
    Route::get('/', [C_Admin::class, 'dashboard'])->name('dashboard');
    Route::get('/logout',[C_Admin::class,'admin_logout'])->name('logout');
    Route::group(['prefix' => 'minat_bakat'], function () {
        Route::get('/', [C_M_Admin::class, 'user_test'])->name('minat.dashboard');
        Route::group(['prefix' => 'setting_page'], function () {
            Route::get('/', [C_M_Admin::class, 'setting_page'])->name('minat.setting.dashboard');
            Route::get('/create', [C_M_Admin::class, 'page_create_soal'])->name('minat.setting.soal.create');
            Route::post('/create', [C_M_Admin::class, 'create_soal'])->name('minat.setting.soal.send');
            Route::post('/delete', [C_M_Admin::class, 'delete_soal'])->name('minat.setting.soal.delete');
            Route::post('/edit', [C_M_Admin::class, 'edit_soal'])->name('minat.setting.soal.edit');
            Route::post('/description', [C_M_Admin::class, 'edit_description'])->name('minat.setting.description');
        });
    });
    Route::group((['prefix' => 'user']), function () {
        Route::get('/', [C_U_Admin::class, 'dashboard'])->name('user.dashboard');
        Route::post('/create', [C_U_Admin::class, 'create_user'])->name('user.create');
        Route::post('/edit', [C_U_Admin::class, 'edit_user'])->name('user.edit');
        Route::post('/delete', [C_U_Admin::class, 'delete_user'])->name('user.delete');
    });
    Route::group((['prefix' => 'Role']), function () {
        Route::get('/', [C_R_Admin::class, 'dashboard'])->name('role.dashboard');
        Route::get('/permission', [C_R_Admin::class, 'permission'])->name('role.permission');
        Route::post('/create', [C_R_Admin::class, 'create'])->name('role.create');
        Route::put('/update/{id}', [C_R_Admin::class, 'update'])->name('role.update');
        Route::delete('/delete/{id}', [C_R_Admin::class, 'delete'])->name('role.delete');
    });
});
?>