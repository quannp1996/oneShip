<?php

namespace App\Containers\StaticPage\Tasks;

use App\Containers\StaticPage\Data\Repositories\StaticPageRepository;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Arr;

/**
 * Class CreateStaticPageTask.
 */
class CreateStaticPageTask extends Task
{
    protected $repository;

    public function __construct(StaticPageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($data)
    {
        try {
            $data = Arr::except($data, ['staticpage_description', '_token', '_headers']);
            if (isset($data['position'])) {
                $data['position'] = is_array($data['position']) ? implode(',', $data['position']) : $data['position'];
            }

            return $this->repository->create($data);
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
