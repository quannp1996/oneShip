<?php

namespace App\Containers\StaticPage\Tasks;

use App\Containers\StaticPage\Data\Repositories\StaticPageRepository;
use App\Ship\Parents\Tasks\Task;

/**
 * Class FindStaticPageByIDTask.
 */
class FindStaticPageByIDTask extends Task
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
    public function run($id, $defaultLanguage = 1, $external_data = ['with_relationship' => ['all_desc']])
    {
        $data = $this->repository->with(array_merge($external_data['with_relationship']))->find($id);
        return $data;
    }
}