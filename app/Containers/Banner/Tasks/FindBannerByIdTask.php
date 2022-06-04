<?php

namespace App\Containers\Banner\Tasks;

use App\Containers\Banner\Data\Repositories\BannerRepository;
use App\Ship\Parents\Tasks\Task;

/**
 * Class FindBannerByIdTask.
 */
class FindBannerByIdTask extends Task
{

    protected $repository;

    public function __construct(BannerRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     *
     * @return  mixed
     */
    public function run($banner_id, $defaultLanguage = 1, $external_data = ['with_relationship' => ['all_desc']])
    {
        
        $data = $this->repository->with(array_merge($external_data['with_relationship']))->find($banner_id);
        
        return $data;
    }
}