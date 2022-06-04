<?php

namespace App\Containers\StaticPage\Tasks;

use App\Containers\StaticPage\Data\Repositories\StaticPageRepository;
use App\Ship\Parents\Tasks\Task;
use Exception;

/**
 * Class EnableStaticPageTask.
 */
class EnableStaticPageTask extends Task
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
            return $this->repository->getModel()->where('id', $id)->update([
                'status' => '2'
            ]);
        } catch (Exception $exception) {
            throw $exception;
        }
        return false;
    }
}
