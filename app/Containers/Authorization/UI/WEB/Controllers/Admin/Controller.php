<?php

namespace App\Containers\Authorization\UI\WEB\Controllers\Admin;

use Apiato\Core\Foundation\Facades\Apiato;
use Apiato\Core\Foundation\Facades\FunctionLib;
use App\Containers\Authorization\UI\API\Requests\AssignUserToRoleRequest;
use App\Containers\Authorization\UI\API\Requests\AttachPermissionToRoleRequest;
use App\Containers\Authorization\UI\WEB\Requests\Admin\CreateRoleRequest;
use App\Containers\Authorization\UI\WEB\Requests\Admin\DeleteRoleRequest;
use App\Containers\Authorization\UI\API\Requests\DetachPermissionToRoleRequest;
use App\Containers\Authorization\UI\WEB\Requests\Admin\FindPermissionRequest;
use App\Containers\Authorization\UI\WEB\Requests\Admin\FindRoleRequest;
use App\Containers\Authorization\UI\API\Requests\GetAllPermissionsRequest;
use App\Containers\Authorization\UI\WEB\Requests\Admin\GetAllRolesRequest;
use App\Containers\Authorization\UI\API\Requests\RevokeUserFromRoleRequest;
use App\Containers\Authorization\UI\API\Requests\SyncPermissionsOnRoleRequest;
use App\Containers\Authorization\UI\API\Requests\SyncUserRolesRequest;
use App\Containers\Authorization\UI\WEB\Requests\Admin\UpdateRoleRequest;
use App\Containers\Authorization\UI\API\Transformers\PermissionTransformer;
use App\Containers\Authorization\UI\API\Transformers\RoleTransformer;
use App\Containers\Authorization\UI\WEB\Requests\Admin\CreatePermissionRequest;
use App\Containers\Authorization\UI\WEB\Requests\Admin\UpdatePermissionRequest;
use App\Containers\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\AdminController;
use App\Ship\Transporters\DataTransporter;

/**
 * Class Controller.
 *
 * @author Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Controller extends AdminController
{

    public function __construct()
    {
        $this->title = 'Phân quyền';

        parent::__construct();
    }

    public function getAllPermissions(GetAllPermissionsRequest $request)
    {
        $title = 'Quyền hạn';
        \View::share('site_title', 'Quản trị '. $title);
        Apiato::call('BaseContainer@CreateBreadcrumbAction', ['list', $title]);

        $permissions = Apiato::call('Authorization@GetAllPermissionsAction', [new DataTransporter($request), $this->perPage]);

        return view('authorization::Admin.Permission.index', [
            'search_data' => $request,
            'data' => $permissions
        ]);
    }

    public function findPermission(FindPermissionRequest $request)
    {
        $this->showEditForm();
        $permission = Apiato::call('Authorization@FindPermissionAction', [new DataTransporter($request)]);

        if ($permission) {
            Apiato::call('BaseContainer@CreateBreadcrumbAction', ['edit', 'Quyền hạn', 'admin_authorization_get_all_perms']);

            return view('authorization::Admin.Permission.edit', [
                'data' => $permission,
                'containers' => Apiato::getContainersNames()
            ]);
        }
        abort(404);
    }

    public function addPermission()
    {
        $this->showAddForm();
        Apiato::call('BaseContainer@CreateBreadcrumbAction', ['add', 'Quyền hạn', 'admin_authorization_get_all_perms']);

        return view('authorization::Admin.Permission.edit', [
            'containers' => Apiato::getContainersNames()
        ]);
    }

    public function getAllRoles(GetAllRolesRequest $request)
    {
        $title = 'Nhóm quyền';
        \View::share('site_title', 'Quản trị '. $title);
        Apiato::call('BaseContainer@CreateBreadcrumbAction', ['list', $title]);

        $roles = Apiato::call('Authorization@GetAllRolesAction', [new DataTransporter($request), $this->perPage]);

        return view('authorization::Admin.Role.index', [
            'search_data' => $request,
            'data' => $roles
        ]);
    }

    public function addRole()
    {
        Apiato::call('BaseContainer@CreateBreadcrumbAction', ['add', 'Nhóm quyền', 'admin_authorization_get_all_roles']);

        $this->showAddForm();
        $all_perms = Apiato::call('Authorization@GetAllPermToGroupAction');

        return view('authorization::Admin.Role.edit', [
            'all_perms' => $all_perms
        ]);
    }

    public function findRole(FindRoleRequest $request)
    {
        $this->showEditForm();
        $role = Apiato::call('Authorization@FindRoleAction', [new DataTransporter($request)]);

        if ($role) {
            Apiato::call('BaseContainer@CreateBreadcrumbAction', ['edit', 'Nhóm quyền', 'admin_authorization_get_all_roles']);

            $all_perms = Apiato::call('Authorization@GetAllPermToGroupAction');

            return view('authorization::Admin.Role.edit', [
                'search_data' => $request,
                'data' => $role,
                'all_perms' => $all_perms
            ]);
        } else {
            abort(404);
        }
    }

    public function assignUserToRole(AssignUserToRoleRequest $request)
    {
        $user = Apiato::call('Authorization@AssignUserToRoleAction', [new DataTransporter($request)]);

        return $this->transform($user, UserTransformer::class);
    }

    public function syncUserRoles(SyncUserRolesRequest $request)
    {
        $user = Apiato::call('Authorization@SyncUserRolesAction', [new DataTransporter($request)]);

        return $this->transform($user, UserTransformer::class);
    }

    public function deleteRole(DeleteRoleRequest $request)
    {
        Apiato::call('Authorization@DeleteRoleAction', [new DataTransporter($request)]);

        return $this->noContent();
    }

    public function revokeRoleFromUser(RevokeUserFromRoleRequest $request)
    {
        $user = Apiato::call('Authorization@RevokeUserFromRoleAction', [new DataTransporter($request)]);

        return $this->transform($user, UserTransformer::class);
    }

    public function attachPermissionToRole(AttachPermissionToRoleRequest $request)
    {
        $role = Apiato::call('Authorization@AttachPermissionsToRoleAction', [new DataTransporter($request)]);

        return $this->transform($role, RoleTransformer::class);
    }

    public function syncPermissionOnRole(SyncPermissionsOnRoleRequest $request)
    {
        $role = Apiato::call('Authorization@SyncPermissionsOnRoleAction', [new DataTransporter($request)]);

        return $this->transform($role, RoleTransformer::class);
    }

    public function detachPermissionFromRole(DetachPermissionToRoleRequest $request)
    {
        $role = Apiato::call('Authorization@DetachPermissionsFromRoleAction', [new DataTransporter($request)]);

        return $this->transform($role, RoleTransformer::class);
    }

    public function createRole(CreateRoleRequest $request)
    {
        try {
            $role = Apiato::call('Authorization@CreateRoleAction', [new DataTransporter($request)]);

            if ($role) {
                $permissions = Apiato::call('Authorization@AttachPermissionsToRoleAction', [new DataTransporter($request), $role->id]);

                return redirect()->route('admin_authorization_get_all_roles')->with('status', $role->name . ' đã được thêm mới');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error:' => 'Có lỗi trong quá trình lưu dữ liệu! Vui lòng thử lại! ' . $e->getMessage()]);
        }
    }

    public function createPermission(CreatePermissionRequest $request)
    {
        try {
            $role = Apiato::call('Authorization@CreatePermissionAction', [new DataTransporter($request)]);

            if ($role) {

                return redirect()->route('admin_authorization_get_all_perms')->with('status', $role->name . ' đã được thêm mới');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error:' => 'Có lỗi trong quá trình lưu dữ liệu! Vui lòng thử lại! ' . $e->getMessage()]);
        }
    }

    public function updateRole(UpdateRoleRequest $request)
    {
        try {
            $role = Apiato::call('Authorization@UpdateRoleAction', [new DataTransporter($request)]);

            if ($role) {
                return redirect()->route('admin_authorization_edit_role', ['id' => $role->getHashedKey()])->with('status', $role->name . ' đã được cập nhật');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error:' => 'Có lỗi trong quá trình lưu dữ liệu! Vui lòng thử lại! ' . $e->getMessage()]);
        }
    }

    public function updatePermission(UpdatePermissionRequest $request)
    {
        try {
            $role = Apiato::call('Authorization@UpdatePermissionAction', [new DataTransporter($request)]);

            if ($role) {
                return redirect()->route('admin_authorization_edit_perm', ['id' => $role->getHashedKey()])->with('status', $role->name . ' đã được cập nhật');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error:' => 'Có lỗi trong quá trình lưu dữ liệu! Vui lòng thử lại! ' . $e->getMessage()]);
        }
    }
}
