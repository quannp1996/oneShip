<?php

namespace App\Containers\Banner\Tasks;

use App\Containers\Banner\Data\Repositories\BannerRepository;
use App\Ship\Parents\Tasks\Task;
use Exception;

/**
 * Class DeleteBannerTask.
 */
class EnableBannerTask extends Task
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
    public function run($banner_id)
    {
        try {
            $this->repository->getModel()->where('id', $banner_id)->update(
                [
                    'status' => 2
                ]
            );
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
