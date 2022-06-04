<?php

namespace App\Containers\Banner\Tasks;

use App\Containers\Banner\Data\Repositories\BannerDescRepository;
use App\Ship\Parents\Tasks\Task;
use Exception;

/**
 * Class DeleteBannerDescTask.
 */
class DeleteBannerDescTask extends Task
{

    protected $repository;

    public function __construct(BannerDescRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     *
     * @return  mixed
     */
    public function run($banner_id)
    {
        try {
            $this->repository->getModel()->where('banner_id', $banner_id)->delete();
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
