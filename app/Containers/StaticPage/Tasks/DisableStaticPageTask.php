<?php

namespace App\Containers\StaticPage\Tasks;

use App\Containers\StaticPage\Data\Repositories\BannerRepository;
use App\Containers\StaticPage\Data\Repositories\StaticPageRepository;
use App\Ship\Parents\Tasks\Task;
use Exception;

/**
 * Class DisableStaticPageTask.
 */
class DisableStaticPageTask extends Task
{

    protected $repository;

    public function __construct(StaticPageRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     *
     * @return  mixed
     */
    public function run($id)
    {
        try {
            return $this->repository->getModel()->where('id', $id)->update(
                [
                    'status' => '1'
                ]
            );
        } catch (Exception $exception) {
            throw $exception;
        }
        return false;
    }
}
