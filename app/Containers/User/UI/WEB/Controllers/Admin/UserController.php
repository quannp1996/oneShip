<?php

namespace App\Containers\User\UI\WEB\Controllers\Admin;

use Apiato\Core\Foundation\Facades\Apiato;
use Apiato\Core\Foundation\FunctionLib;
use App\Containers\User\UI\WEB\Requests\Admin\CreateUserFormRequest;
use App\Containers\User\UI\WEB\Requests\Admin\CreateUserRequest;
use App\Containers\User\UI\WEB\Requests\Admin\DeleteUserRequest;
use App\Containers\User\UI\WEB\Requests\Admin\FindUserByIdRequest;
use App\Containers\User\UI\WEB\Requests\Admin\GetAllUsersRequest;
use App\Containers\User\UI\WEB\Requests\Admin\UpdateUserRequest;
use App\Ship\core\Traits\HelpersTraits\ApiResTrait;
use App\Ship\Parents\Controllers\AdminController;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Carbon;


/**
 * Class Controller
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class UserController extends AdminController
{
    use ApiResTrait;

    public function __construct()
    {
        $this->title = 'Quản trị viên';
        if (FunctionLib::isDontUseShareData(['filterUser'])) {
            $this->dontUseShareData = true;
        }
        parent::__construct();
    }
    /**
     * @return  \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(GetAllUsersRequest $request)
    {

        Apiato::call('BaseContainer@CreateBreadcrumbAction', ['list', $this->title]);

        $users = Apiato::call('User@GetAllUsersAction', [new DataTransporter($request), $this->perPage]);

        // dd($users);
        return view('user::admin.index', [
            'search_data' => $request,
            'data' => $users,
            'statusOpt' => Apiato::call('User@GetOptStatusAction')
        ]);
    }

    public function editUser(FindUserByIdRequest $request)
    {
        $user = Apiato::call('User@FindUserByIdAction', [new DataTransporter($request)]);

        if ($user) {
            $this->showEditForm();
            Apiato::call('BaseContainer@CreateBreadcrumbAction', ['edit', $this->title, 'get_user_home_page']);

            $roles = Apiato::call('Authorization@GetAllRolesAction', [new DataTransporter([]), 0, true]);

            $all_perms = Apiato::call('Authorization@GetAllPermToGroupAction');

            $user_perms = array_flip($user->getPermissionNames()->toArray());

            return view('user::admin.edit', [
                'data' => $user,
                'roles' => $roles,
                'all_perms' => $all_perms,
                'user_perms' => $user_perms
            ]);
        }

        return abort(404);
    }

    public function updateUser(UpdateUserRequest $request)
    {
        if(!FunctionLib::is_mobile($request->phone)){
            return redirect()->back()->withInput()->withErrors(['phone' => 'Số điện thoại không hợp lệ']);
        }
        try {
            $transporter = new DataTransporter($request);
            $user = Apiato::call('User@UpdateUserAction', [$transporter]);
            if ($user) {
                $transporter->user_id = $user->id;
                if (!empty($transporter->roles_ids)) {
                    $user = Apiato::call('Authorization@SyncUserRolesAction', [$transporter]);
                }
                if (!empty($transporter->permissions_ids)) {
                    $user = Apiato::call('Authorization@SyncUserPermissionsAction', [$transporter]);
                }
                return redirect()->route('admin_user_edit_page', ['id' => $user->getHashedKey()])->with('status', $user->name . ' đã được cập nhật');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error:' => 'Có lỗi trong quá trình lưu dữ liệu! Vui lòng thử lại! ' . $e->getMessage()]);
        }
    }

    public function addUser(CreateUserFormRequest $request)
    {
        $this->showAddForm();

        Apiato::call('BaseContainer@CreateBreadcrumbAction', ['add', $this->title, 'get_user_home_page']);

        $roles = Apiato::call('Authorization@GetAllRolesAction', [new DataTransporter([]), 0, true]);

        $all_perms = Apiato::call('Authorization@GetAllPermToGroupAction');

        return view('user::admin.edit', [
            'roles' => $roles,
            'all_perms' => $all_perms,
        ]);
    }

    public function createUser(CreateUserRequest $request)
    {
        if(!FunctionLib::is_mobile($request->phone)){
            return redirect()->back()->withInput()->withErrors(['phone' => 'Số điện thoại không hợp lệ']);
        }
        try {
            $transporter = new DataTransporter($request);
            $user = Apiato::call('User@CreateUserAction', [$transporter]);
            if ($user) {
                $transporter->user_id = $user->id;
                if (!empty($transporter->roles_ids)) {
                    $user = Apiato::call('Authorization@SyncUserRolesAction', [$transporter]);
                }
                if (!empty($transporter->permissions_ids)) {
                    $user = Apiato::call('Authorization@SyncUserPermissionsAction', [$transporter]);
                }
                return redirect()->route('get_user_home_page')->with('status', $user->name . ' đã được thêm mới');
            }
        } catch (\Exception $e) {
            // throw $e;
            return redirect()->back()->withInput()->withErrors(['error:' => 'Có lỗi trong quá trình lưu dữ liệu! Vui lòng thử lại! ' . $e->getMessage()]);
        }
    }

    public function activeLog(){
        $user = \Auth::user();
        $user->last_active = Carbon::now();
        $user->save();
        return FunctionLib::ajaxRespondV2(true,'Success');
    }

    public function delete(DeleteUserRequest $request){
        try {
            $result = Apiato::call('User@DeleteUserAction', [new DataTransporter($request)]);
            if(!$result){
                return redirect()->back()->withInput()->withErrors(['error:' => 'Lỗi! Không tìm thấy người dùng']);
            }
        } catch (\Exception $e) {
            // throw $e;
            return redirect()->back()->withInput()->withErrors(['error:' => 'Có lỗi trong quá trình lưu dữ liệu! Vui lòng thử lại! ' . $e->getMessage()]);
        }
    }

    public function active(FindUserByIdRequest $request){
        try {
            Apiato::call('User@ActiveUserAction', [$request]);
            return FunctionLib::ajaxRespondV2(true,'Success');
        } catch (\Exception $e) {
            // throw $e;
            return redirect()->back()->withInput()->withErrors(['error:' => 'Có lỗi trong quá trình lưu dữ liệu! Vui lòng thử lại! ' . $e->getMessage()]);
        }
    }

    public function filterUser(GetAllUsersRequest $request)
    {
        $transporter = $request->toTransporter();
        $users = Apiato::call('User@FilterUserByKeywordAction', [$transporter, [
            'id',
            'name',
            'email'
        ]]);
        return $this->sendResponse($users);
    }
} // End class
