<?php

namespace App\Containers\Settings\Tasks;

use App\Containers\Settings\Data\Repositories\SettingRepository;
use App\Containers\Settings\Models\Setting;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateSettingTask extends Task
{

    protected $repository;

    public function __construct(SettingRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     *
     * @return Setting
     * @throws CreateResourceFailedException
     */
    public function run($data,$key): Setting
    {
        try {
            return $this->repository->create(['key' => $key,'value' => json_encode($data)]);
        }
        catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}
