<?php

namespace App\Containers\Localization\Tasks;

use App\Containers\Localization\Data\Repositories\LanguageRepository;
use App\Ship\Parents\Tasks\Task;

class GetAllLanguageDBTask extends Task
{

    protected $repository;

    public function __construct(LanguageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->all();
    }
}
