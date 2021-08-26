<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = Permission::all();
        
        $admin_permissions = $permissions->filter(function ($permission) 
        {
            return substr($permission->title, 0, 9) != 'incoming_' && substr($permission->title, 0, 9) != 'outgoing_' && substr($permission->title, 0, 6) != 'staff_';
        });

        $coordinator_permissions = $permissions->filter(function ($permission) 
        {
            return substr($permission->title, 0, 5) != 'user_' && substr($permission->title, 0, 11) != 'department_' && substr($permission->title, 0, 5) != 'role_' && substr($permission->title, 0, 11) != 'permission_';
        });

        $staff_permissions = $coordinator_permissions->filter(function ($permission) 
        {
            return substr($permission->title, 0, 6) != 'staff_';
        });

        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));
        Role::findOrFail(2)->permissions()->sync($coordinator_permissions->pluck('id'));
        Role::findOrFail(3)->permissions()->sync($staff_permissions->pluck('id'));
    }
}
