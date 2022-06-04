<?php

namespace App\Containers\Authorization\Data\Seeders;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Seeders\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class AuthorizationPermissionsSeeder_1
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class AuthorizationPermissionsSeeder_1 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->truncate();
        //ADMIN PERMISSIONS
        // Default Permissions ----------------------------------------------------------
        Apiato::call('Authorization@CreatePermissionTask', ['manage-roles', 'Create, Update, Delete, Get All, Attach/detach permissions to Roles and Get All Permissions.', 'Authorization']);
        Apiato::call('Authorization@CreatePermissionTask', ['create-admins', 'Create new Users (Admins) from the dashboard.', 'Authorization']);
        Apiato::call('Authorization@CreatePermissionTask', ['manage-admins-access', 'Assign users to Roles.', 'Authorization']);
        Apiato::call('Authorization@CreatePermissionTask', ['access-dashboard', 'Access the admins dashboard.', 'Authorization']);
        Apiato::call('Authorization@CreatePermissionTask', ['access-dashboard', 'Access the admins dashboard.', 'Authorization']);
        Apiato::call('Authorization@CreatePermissionTask', ['access-dashboard', 'Access the admins dashboard.', 'Authorization']);
        Apiato::call('Authorization@CreatePermissionTask', ['access-dashboard', 'Access the admins dashboard.', 'Authorization']);
        Apiato::call('Authorization@CreatePermissionTask', ['access-dashboard', 'Access the admins dashboard.', 'Authorization']);
        // DB::table('permissions')->insert($permissions);
        
        // Apiato::call('Authorization@CreatePermissionTask', ['access-news', 'Access the News List']);
        // Apiato::call('Authorization@CreatePermissionTask', ['edit-news', 'Edit or Add new News']);
        // Apiato::call('Authorization@CreatePermissionTask', ['delete-news', 'Delete the News']);
    }
}
