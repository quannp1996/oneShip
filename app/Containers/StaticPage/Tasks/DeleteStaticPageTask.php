<?php

namespace App\Containers\StaticPage\Tasks;

use App\Containers\StaticPage\Data\Repositories\StaticPageRepository;
use App\Ship\Parents\Tasks\Task;
use Exception;

/**
 * Class DeleteStaticPageTask.
 */
class DeleteStaticPageTask extends Task
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
            $this->repository->delete($id);
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
