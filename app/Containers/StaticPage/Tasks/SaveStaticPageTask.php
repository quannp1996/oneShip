<?php

namespace App\Containers\StaticPage\Tasks;

use App\Containers\StaticPage\Data\Repositories\StaticPageRepository;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Arr;

/**
 * Class SaveStaticPageTask.
 */
class SaveStaticPageTask extends Task
{
    protected $repository;

    public function __construct(StaticPageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($data)
    {
        try {
            $dataUpdate = Arr::except($data, ['staticpage_description', '_token', '_headers']);
            if (isset($dataUpdate['position'])) {
                $dataUpdate['position'] = is_array($dataUpdate['position']) ? implode(',', $dataUpdate['position']) : $dataUpdate['position'];
            } else {
                $dataUpdate['position'] = null;
            }

            return $this->repository->update($dataUpdate, $data['id']);
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
