<?php

namespace App\Containers\User\Data\Criterias;

use Apiato\Core\Foundation\Facades\FunctionLib;
use App\Ship\Parents\Criterias\Criteria;
use Illuminate\Support\Carbon;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class AdminFilterCriteria.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class AdminFilterCriteria extends Criteria
{

    public $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * @param                                                   $model
     * @param \Prettus\Repository\Contracts\RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        if(!empty($this->request->status) && $this->request->status > 0){
            $model = $model->where('status', $this->request->status);
        }else{
            $model = $model->where('status', '>', 0);
        }
        if(!empty($this->request->name)){
            $model = $model->where('name', 'like', '%'.$this->request->name.'%');
        }
        if(!empty($this->request->email)){
            $model = $model->where('email', 'like', '%'.$this->request->email.'%');
        }
        if(!empty($this->request->phone)){
            $model = $model->where('phone', 'like', '%'.$this->request->phone.'%');
        }
        if (!empty($this->request->time_from)) {
            $timeFrom = Carbon::createFromTimestamp(FunctionLib::getTimestampFromVNDate($this->request->time_from));
            $model = $model->whereDate('created_at', '>=', $timeFrom);
        }
        if (!empty($this->request->time_to)) {
            $timeTo = Carbon::createFromTimestamp(FunctionLib::getTimestampFromVNDate($this->request->time_to, true));
            $model = $model->whereDate('created_at', '<=', $timeTo);
        }

        return $model;
    }
}
