<?php 
namespace App\Containers\Order\Export;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Containers\Order\Actions\GetAllOrdersAction;

class ExportOrderView implements FromView
{
    protected array $condition = [];
    public function __construct(array $condition = [])
    {
        $this->condition = $condition;
    }

    public function view(): View
    {
        $orders = app(GetAllOrdersAction::class)->run($this->condition, ['shipping', 'senderProvince', 'senderDistrict', 'senderWard', 'receiverProvince', 'receiverWard', 'receiverDistrict']);
        return view('order::export.index', [
            'orders' => $orders
        ]);
    }
}
