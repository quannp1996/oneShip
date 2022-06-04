<?php

namespace App\Containers\StaticPage\Tasks;

use App\Containers\StaticPage\Data\Repositories\StaticPageDescRepository;
use App\Ship\Parents\Tasks\Task;
use Exception;

/**
 * Class DeleteStaticPageDescTask.
 */
class DeleteStaticPageDescTask extends Task
{

    protected $repository;

    public function __construct(StaticPageDescRepository $repository)
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
            $this->repository->getModel()->where('static_page_id', $id)->delete();
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
