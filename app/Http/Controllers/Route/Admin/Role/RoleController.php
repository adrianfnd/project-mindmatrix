<?php

namespace App\Http\Controllers\Route\Admin\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Request
use App\Http\Requests\Default\Search as Search;
use App\Http\Requests\Role\Create as R_C_Role;

// controller
use App\Http\Controllers\Component\Role\RoleController as C_Role;

class RoleController extends C_Role
{
    public function dashboard(Search $request){
        $value = $request->validated();
        $value['search'] = (isset($value['search'])) ? $value['search'] : null;
        $roles = $this->saerch($value['search'],$value['limit_per_page']);
        return view('Admin.Settings.Role.dashboard',['roles' => $roles]);
    }
    public function permission(Request $request){
        $value = $request->validate([
            'nama_role' => ['required','string','exists:roles,name'],
        ]);
        dd($value);
    }

    public function create(R_C_Role $request){
        $value = $request->validated();
        $status_craete = $this->create_role_name($value['nama_role']);
        return redirect()->route('admin.role.permission',['name_role' => $status_craete]);
        
    }
}
