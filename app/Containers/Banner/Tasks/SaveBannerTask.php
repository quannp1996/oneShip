<?php

namespace App\Containers\Banner\Tasks;

use Apiato\Core\Foundation\FunctionLib;
use App\Containers\Banner\Data\Repositories\BannerRepository;
use App\Containers\Banner\Enums\BannerType;
use App\Ship\Parents\Tasks\Task;
use Carbon\Carbon;
use Illuminate\Support\Arr;

/**
 * Class SaveBannerTask.
 */
class SaveBannerTask extends Task
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
    public function run($data)
    {
        try {
            $dataUpdate = Arr::except($data, ['banner_description', '_token', '_headers']);
            $dataUpdate["publish_at"] = !empty($dataUpdate['publish_at']) ? Carbon::createFromTimestamp(FunctionLib::getTimestampFromVNDate($dataUpdate['publish_at'])) : Carbon::now();
            $dataUpdate["end_at"] = !empty($dataUpdate['end_at']) ? Carbon::createFromTimestamp(FunctionLib::getTimestampFromVNDate($dataUpdate['end_at'])) : Carbon::now()->addDays(config('banner-container.days_of_end_at_default'));
            $dataUpdate['position'] =  is_array($dataUpdate['position']) ? implode(',', $dataUpdate['position']) : $dataUpdate['position'];
            $dataUpdate['is_mobile'] = isset($data['is_mobile']) ? BannerType::MOBILE : BannerType::DESKTOP;

            $banner = $this->repository->update($dataUpdate, $data['id']);
            return $banner;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}
