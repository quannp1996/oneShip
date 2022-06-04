<?php

namespace Apiato\Core\Traits;

use Apiato\Core\Foundation\FunctionLib;
use App\Containers\Localization\Actions\GetCurrentLangAction;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;
use App\Ship\Criterias\Eloquent\ThisInSubThatCriteria;
use App\Ship\Criterias\Eloquent\ThisOperationThatCriteria;
use Carbon\Carbon;

trait FilterFields
{
    public function filter(array $condition = []){
        foreach ($this->equalFields as $key) {
            if (!empty($condition[$key])) {
                $this->repository->pushCriteria(new ThisEqualThatCriteria($key, $condition[$key]));
            }
        }
        if(!empty($condition['title'])){
            $language = app(GetCurrentLangAction::class)->run();
            $this->repository->pushCriteria(new ThisInSubThatCriteria('id', function($query) use ($language, $condition){
                $query->select('project_id')->from('project_descriptions')
                    ->where('language_id', $language->language_id)->where('title', 'LIKE', '%'.$condition['title'].'%');
            }));
        }
        if(!empty($condition['time_from'])){
            $timeFrom = Carbon::createFromTimestamp(FunctionLib::getTimestampFromVNDate($condition['time_from']));
            $this->repository->pushCriteria(new ThisOperationThatCriteria('created_at', $timeFrom, '>='));
        }
        if(!empty($condition['time_to'])){
            $timeTo = Carbon::createFromTimestamp(FunctionLib::getTimestampFromVNDate($condition['time_to'], true));
            $this->repository->pushCriteria(new ThisOperationThatCriteria('created_at', $timeTo, '<='));
        }
        return $this;
    }
}
