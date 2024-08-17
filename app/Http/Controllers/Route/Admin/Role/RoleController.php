<?php

namespace App\Http\Controllers\Route\Admin\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Default\Search as Search;
use App\Http\Requests\Role\Create as R_C_Role;
use App\Http\Requests\Role\Update as R_U_Role;
use App\Http\Controllers\Component\Role\RoleController as C_Role;

class RoleController extends C_Role
{
    public function dashboard(Search $request){
        $value = $request->validated();
        $value['search'] = (isset($value['search'])) ? $value['search'] : null;
        $roles = $this->saerch($value['search'],$value['limit_per_page']);
        return view('admin.settings.role.index',['roles' => $roles]);
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

    public function update(R_U_Role $request, $id)
    {
        $value = $request->validated();
        $role = $this->update_role_name($id, $value['nama_role']);
        return redirect()->route('admin.role.dashboard')->with('success', 'Role updated successfully');
    }

    public function delete($id)
    {
        try {
            $this->delete_role($id);
            return redirect()->route('admin.role.dashboard')->with('success', 'Role deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.role.dashboard')->with('error', 'Failed to delete role');
        }
    }
}