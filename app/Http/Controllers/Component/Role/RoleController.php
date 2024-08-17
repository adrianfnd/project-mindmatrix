<?php

namespace App\Http\Controllers\Component\Role;

use App\Http\Controllers\Controller;


// model
use App\Models\Role as Role;
use App\Models\Permission as Permission;

class RoleController extends Controller
{
    private $role_guard = ['web','api'];
    public function create_role_name(String $role){
        foreach($this->role_guard as $value){
            Role::create(['name' => $role ,'guard_name' => $value ]);
        }
        return $role;
    }
    
    public function saerch(String $search = null,int $limit = 10){
        $role = Role::where('name','!=','Admin');
        if($search != null){
            $role = $role->where('name','like','%'.$search.'%');
        } 
        $role = $role->paginate($limit);
        return $role;
    }

    public function update_role_name($uuid, String $role)
    {
        $roleModel = Role::where('uuid', $uuid)->firstOrFail();
        $roleModel->update(['name' => $role]);
        return $role;
    }
    
    public function delete_role($uuid)
    {
        $roleModel = Role::where('uuid', $uuid)->firstOrFail();
        $roleModel->delete();
    }
}
