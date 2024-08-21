<?php

namespace App\Http\Controllers\Route\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Default\Search as R_Search;
use App\Http\Requests\User\UserCreate as R_C_User;
use App\Http\Requests\User\UserDetail as R_D_User;
use App\Http\Requests\User\UserEdit as R_E_User;

use App\Http\Controllers\Component\User\UserController as C_User;


class UserController extends C_User
{
    public function dashboard(R_Search $request){
        $value = $request->validated();
        $value['search'] = (isset($value['search'])) ? $value['search'] : null;
        $users = $this->search($value['search'],$value['limit_per_page']);
        return view('admin.settings.user.index',['users' => $users ]);
    }

    public function create_user(R_C_User $request){
        $value = $request->validated();
        $status_create = $this->create($value['email'],$value['nama_lengkap'],$value['tanggal_lahir'],$value['password']);
        return redirect()->route('admin.user.dashboard')->with('create',"Berhasil membuat user");
    }

    public function edit_user(R_E_User $request){
        $value = $request->validated();
        $status_edit = $this->edit($value['id_user'], $value['email'], $value['nama_lengkap']);
        return redirect()->route('admin.user.dashboard')->with('edit', "Berhasil mengubah data user");
    }
    
    public function delete_user(R_D_User $request){
        $value = $request->validated();
        $status_create = $this->delete($value['id_user']);
        return redirect()->route('admin.user.dashboard')->with('delete',"Berhasil menghapus user");
    }
}
