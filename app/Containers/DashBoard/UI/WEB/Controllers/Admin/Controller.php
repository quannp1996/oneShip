<?php

namespace App\Containers\DashBoard\UI\WEB\Controllers\Admin;

use Apiato\Core\Foundation\Facades\Apiato;
use Apiato\Core\Foundation\FunctionLib;
use App\Containers\DashBoard\UI\WEB\Requests\Admin\ViewDashboardRequest;
use App\Containers\DashBoard\UI\WEB\Requests\GetTopProductStatisticRequest;
use App\Containers\SocialAuth\UI\API\Requests\ApiAuthenticateRequest;
use App\Ship\core\Traits\HelpersTraits\ApiResTrait;
use App\Ship\Parents\Controllers\AdminController;
use App\Ship\Transporters\DataTransporter;
use Exception;
use Illuminate\Support\Facades\Cookie;

/**
 * Class Controller
 *
 *
 */
class Controller extends AdminController
{
  use ApiResTrait;
  public function __construct()
  {
    if (FunctionLib::isDontUseShareData([
      'thongke',
      'ordersStatistic',
      'revenueStatistic',
      'topProductsStatistic',
      'discountCodeStatistic',
      'purchasedAbilityStatistic'
    ])) {
      $this->dontUseShareData = true;
    }

    parent::__construct();
  }
  /**
   * @param \App\Containers\DashBoard\UI\WEB\Requests\Admin\ViewDashboardRequest $request
   *
   * @return  \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function viewDashboardPage(ViewDashboardRequest $request)
  {
    // dd(\Auth::guard('admin')->user());
    // dd(\Route::getRoutes());
    // dd(Cookie::get('xxxx'));
    // $content = session()->get('access-token');
    // Cookie::set('refreshToken', $content['refresh_cookie']->getValue());
    // // dd(cookie(
    // //     'refreshToken'
    // // ),);

    // dd(Cookie::get('refreshToken'));
    $this->breadcrumb[] = FunctionLib::addBreadcrumb('Bảng điều khiển', route('get_admin_dashboard_page'));
    \View::share('breadcrumb', $this->breadcrumb);
    return view('dashboard::admin.dashboard');
  }

  public function thongke()
  {
    return view('dashboard::admin.thongke');
  }

  public function ordersStatistic() {
    $result = Apiato::call('DashBoard@OrderStatisticDashboardAction');
    return $this->sendResponse($result);
  }

  public function revenueStatistic() {
    $result = Apiato::call('DashBoard@OrderRevenueDashboardAction');
    return $this->sendResponse($result);
  }

  public function topProductsStatistic(GetTopProductStatisticRequest $request) {
    $transporter = $request->toTransporter();
    $result = Apiato::call('DashBoard@GetTopProductDashboardAction', [
      $transporter,
      ['desc:product_id,name,short_description'],
      ['id', 'purchased_count', 'image', 'price'],
      ['purchased_count' => 'DESC']
    ]);
    return $this->sendResponse($result);
  }

  public function discountCodeStatistic() {
    $result = Apiato::call('DashBoard@GetDiscountCodeStatisticAction');
    return $this->sendResponse($result);
  }

  public function purchasedAbilityStatistic() {
    $result = Apiato::call('DashBoard@GetPurchasedAbilityStatisticAction');
    return $this->sendResponse($result);
  }

  public function getProductSingleStatistic(int $productId) {
    $result = Apiato::call('DashBoard@GetProductSingleStatisticAction', [$productId]);
    return $this->sendResponse($result);
  }
} // End class
