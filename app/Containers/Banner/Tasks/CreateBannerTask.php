<?php

namespace App\Containers\Banner\Tasks;

use Apiato\Core\Foundation\FunctionLib;
use App\Containers\Banner\Data\Repositories\BannerRepository;
use App\Containers\Banner\Enums\BannerType;
use App\Ship\Parents\Tasks\Task;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Arr;

/**
 * Class CreateBannerTask.
 */
class CreateBannerTask extends Task
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
            $data = Arr::except($data, ['banner_description', '_token', '_headers']);
            $data["publish_at"] = !empty($data['publish_at']) ? Carbon::createFromTimestamp(FunctionLib::getTimestampFromVNDate($data['publish_at'])) : Carbon::now();
            $data["end_at"] = !empty($data['end_at']) ? Carbon::createFromTimestamp(FunctionLib::getTimestampFromVNDate($data['end_at'])) : Carbon::now()->addDays(config('banner-container.days_of_end_at_default'));
            if(isset($data['position']))
            $data['position'] = is_array($data['position']) ? implode(',', $data['position']) : $data['position'];
            $data['is_mobile'] = isset($data['is_mobile']) ? BannerType::MOBILE : BannerType::DESKTOP;

            $banner = $this->repository->create($data);
            return $banner;
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
