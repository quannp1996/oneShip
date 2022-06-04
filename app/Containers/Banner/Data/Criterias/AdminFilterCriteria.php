<?php
namespace App\Containers\Banner\Data\Criterias;

use Apiato\Core\Foundation\Facades\FunctionLib;
use Carbon\Carbon;
use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class AdminFilterCriteria extends Criteria
{
    public $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function apply($model, PrettusRepositoryInterface $repository) {
        if (!empty($this->request->id) && $this->request->id > 0) {
            $model = $model->where('id', $this->request->id);
        } else {
            if(isset($this->request->status)){
                $model = $model->where('status', $this->request->status);
            }else{
                $model = $model->where('status', '>', 0);
            }
            if($this->request->is_mobile != ''){
                $model = $model->where('is_mobile', $this->request->is_mobile);
            }
            if (!empty($this->request->time_from)) {
                $timeFrom = Carbon::createFromTimestamp(FunctionLib::getTimestampFromVNDate($this->request->time_from));
                $model = $model->whereDate('created_at', '>=', $timeFrom);
            }
            if (!empty($this->request->time_to)) {
                $timeTo = Carbon::createFromTimestamp(FunctionLib::getTimestampFromVNDate($this->request->time_to, true));
                $model = $model->whereDate('created_at', '<=', $timeTo);
            }
            if(!empty($this->request->position)){
                $model->where('position', 'like', '%' . $this->request->position . '%');
            }
        }
        return $model;
    }
} // End class
