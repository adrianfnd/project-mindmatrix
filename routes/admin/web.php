<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Route\Admin\AdminController as C_Admin;
use App\Http\Controllers\Route\Admin\User\userController as C_U_Admin;
use App\Http\Controllers\Route\Admin\Role\RoleController as C_R_Admin;
use App\Http\Controllers\Route\Admin\Minta_bakat\MinatController as C_M_Admin;
use App\Http\Controllers\Route\Admin\Univeritas\UniversitasController as C_Univ_Admin;


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
            Route::group(['prefix' => 'description'],function(){
                Route::post('/', [C_M_Admin::class, 'edit_description'])->name('minat.setting.description');
                // belum beres
                Route::get('/{id}/edit',[C_M_Admin::class,'page_edit_summary'])->name('minat.setting.summary.edit');
                Route::post('/{id}/edit',[C_M_Admin::class,'update_summary'])->name('minta.setting.summary.edit.update');
            });
        });
    });
    Route::group((['prefix' => 'user']), function () {
        Route::get('/', [C_U_Admin::class, 'dashboard'])->name('user.dashboard');
        Route::post('/create', [C_U_Admin::class, 'create_user'])->name('user.create');
        Route::post('/delete', [C_U_Admin::class, 'delete_user'])->name('user.delete');
    });
    Route::group((['prefix' => 'universitas']),function() {
        // belum beres
        Route::get('/',[C_Univ_Admin::class,'dashboard'])->name('univeritas.dashboard');
        Route::get('/create',[C_Univ_Admin::class,'page_create_universitas'])->name('univeritas.dashboard.create.page');
        Route::post('/create',[C_Univ_Admin::class,'send_create_universitas'])->name('univeritas.dashboard.create.send');
        Route::get('/detail',[C_Univ_Admin::class,'page_update_universitas'])->name('univeritas.dashboard.update.page');
        Route::post('/detail',[C_Univ_Admin::class,'send_update_universitas'])->name('univeritas.dashboard.update.send');
        Route::group((['prefix' => 'jurusan']),function(){
            Route::get('/',[C_Univ_Admin::class,'jurusan'])->name('univeritas.jurusan');
            Route::post('/create',[C_Univ_Admin::class,'create_jurusan'])->name('univeritas.jurusan.create');
            Route::post('/update',[C_Univ_Admin::class,'update_jurusan'])->name('univeritas.jurusan.update');
            Route::post('/delete',[C_Univ_Admin::class,'delete_jurusan'])->name('univeritas.jurusan.delete');
        });
    });
    Route::group((['prefix' => 'Role']), function () {
        Route::get('/', [C_R_Admin::class, 'dashboard'])->name('role.dashboard');
        Route::get('/permission', [C_R_Admin::class, 'permission'])->name('role.permission');
        Route::post('/create', [C_R_Admin::class, 'create'])->name('role.create');
    });
});
?>