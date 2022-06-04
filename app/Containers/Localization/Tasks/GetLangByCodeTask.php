<?php

namespace App\Containers\Localization\Tasks;

use App\Containers\Localization\Data\Repositories\LanguageRepository;
use App\Containers\Localization\Models\Language;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;
use App\Ship\Criterias\Eloquent\ThisOperationThatCriteria;
use App\Ship\Parents\Tasks\Task;

class GetLangByCodeTask extends Task
{

    protected $repository;

    public function __construct(LanguageRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    public function run(string $code) : ?Language
    {
        return $this->remember(function () use($code) {
            return $this->repository->pushCriteria(new ThisEqualThatCriteria('short_code',$code))
                        ->pushCriteria(new ThisOperationThatCriteria('status',0,'>'))->orderBy('sort_order')->first();
        });
    }
}
