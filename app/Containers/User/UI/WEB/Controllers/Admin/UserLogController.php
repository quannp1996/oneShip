<?php

namespace App\Containers\User\UI\WEB\Controllers\Admin;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\UI\WEB\Requests\Admin\GetAllUserLogRequest;
use App\Ship\Parents\Controllers\AdminController;


/**
 * Class Controller
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class UserLogController extends AdminController
{
    public function __construct()
    {
        $this->title = 'Lịch sử hoạt động';
        parent::__construct();
    }
    /**
     * @return  \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(GetAllUserLogRequest $request)
    {
        Apiato::call('BaseContainer@CreateBreadcrumbAction', ['list', $this->title]);

        $data = Apiato::call('User@GetAllUserLogAction', [$request, $this->perPage]);

        return view('user::admin.log', [
            'search_data' => $request,
            'data' => $data,
        ]);
    }

    /**
     * @return  \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(GetAllUserLogRequest $request)
    {
        Apiato::call('BaseContainer@CreateBreadcrumbAction', ['detail', $this->title, 'admin_user_log']);

        $data = Apiato::call('User@FindUserLogByIdAction', [$request]);

        if($data) {
            if(!empty($data->before)) {
                $data->before = json_decode($data->before, 1);
            }
            if(!empty($data->after)) {
                $data->after = json_decode($data->after, 1);
            }
            return view('user::admin.log_detail', [
                'data' => $data,
                'deviceOptions' => config('user-container.device')
            ]);
        }
        return $this->notfound($request->id);
    }

    /**
     * @return  \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dump(GetAllUserLogRequest $request)
    {
        $data = Apiato::call('User@FindUserLogByIdAction', [$request]);

        if($data) {
            if(!empty($data->before)) {
                $data->before = json_decode($data->before, 1);
            }
            if(!empty($data->after)) {
                $data->after = json_decode($data->after, 1);
            }

            $needShow = !empty($request->show) ? $request->show : 'before';
            $needShow = $needShow == 'before' ? $data->before : $data->after;

            dd($needShow);
        }
    }
} // End class
