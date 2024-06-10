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
        if($search != null){
            $role = Role::where('name','like','%'.$search.'%')->paginate($limit);
        }else{
            $role = Role::paginate($limit);
        }
        return $role;
    }
}
