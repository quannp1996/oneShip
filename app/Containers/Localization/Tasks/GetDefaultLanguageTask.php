<?php

namespace App\Containers\Localization\Tasks;

use App\Containers\Localization\Data\Repositories\LanguageRepository;
use App\Containers\Localization\Models\Language;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;
use App\Ship\Parents\Tasks\Task;

class GetDefaultLanguageTask extends Task
{

    protected $repository;

    public function __construct(LanguageRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    public function run() : ?Language
    {
        return $this->remember(function () {
            $this->repository->pushCriteria(new ThisEqualThatCriteria('is_default',1));
            return $this->repository->first();
        });
    }
}
