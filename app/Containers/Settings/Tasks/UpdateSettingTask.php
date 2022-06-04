<?php

namespace App\Containers\Settings\Tasks;

use App\Containers\Settings\Data\Repositories\SettingRepository;
use App\Containers\Settings\Models\Setting;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateSettingTask extends Task
{

    protected $repository;

    public function __construct(SettingRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $id
     * @param $data
     *
     * @return Setting
     * @throws UpdateResourceFailedException
     */
    public function run($data,$key): Setting
    {
        try {
            $this->repository->getModel()->where('key',$key)->update(['value' => json_encode($data)]);

            return $this->repository->findByField('key',$key)->first();
        }
        catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
