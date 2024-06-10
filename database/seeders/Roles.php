<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Role as Role;
use App\Models\Permission as Permission;
class Roles extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission_guard = ["api",'web'];
        $permission_role = ["user read","user create","user update","user delete"];

        $role = ["admin"];

        foreach($permission_guard as $value_permission){
            foreach ($role as $value) {
                Role::create(['name' => $value ,'guard_name' => $value_permission]);
            }
            foreach ($permission_role as $value) {
                Permission::create(['name' => $value , 'guard_name' => $value_permission]);
            }
        }

        $user_role = Role::findByName('admin');

        foreach ($permission_role as $value) {
            $user_role->givePermissionTo($value);
        }


    }
}
