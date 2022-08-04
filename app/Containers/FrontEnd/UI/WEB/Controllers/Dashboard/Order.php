<?php 
namespace App\Containers\FrontEnd\UI\WEB\Controllers\Dashboard;

use App\Containers\BaseContainer\UI\WEB\Controllers\NeedAuthController;
use App\Containers\Order\Export\ExportOrderView;
use Maatwebsite\Excel\Facades\Excel;

class Order extends NeedAuthController
{
    public function orders()
    {
        view()->share('user', auth('customer')->user());
        return view('frontend::order.orders');
    }

    public function create()
    {
        view()->share('user', auth('customer')->user());
        return view('frontend::order.create');
    }

    public function export()
    {
        return Excel::download(new ExportOrderView(request()->merge([
            'customerID' => auth('customer')->id()
        ])->all()), 'export'.time().'.xlsx');
    }
}
?>