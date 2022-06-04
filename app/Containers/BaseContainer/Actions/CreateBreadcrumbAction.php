<?php

namespace App\Containers\BaseContainer\Actions;

use Apiato\Core\Foundation\FunctionLib;
use App\Ship\Parents\Actions\Action;

/**
 * Class CreateBreadcrumbAction.
 *
 */
class CreateBreadcrumbAction extends Action
{

    /**
     * @return mixed
     */
    public function run($page = 'list', $title = '', $route_name = 'admin_staticpage_home_page')
    {
        $link = $page == 'list' ? '' : route($route_name);
        $breadcrumb[] = FunctionLib::addBreadcrumb('Danh sách '.$title, $link);
        switch ($page){
            case 'add':
                $breadcrumb[] = FunctionLib::addBreadcrumb('Thêm mới');
                break;
            case 'edit':
                $breadcrumb[] = FunctionLib::addBreadcrumb('Chỉnh sửa thông tin');
                break;
            case 'detail':
                $breadcrumb[] = FunctionLib::addBreadcrumb('Thông tin chi tiết');
                break;
        }
        return $breadcrumb;
    }
}
