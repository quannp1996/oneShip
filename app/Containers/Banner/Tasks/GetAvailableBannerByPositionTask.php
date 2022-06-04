<?php

namespace App\Containers\Banner\Tasks;

use App\Containers\Banner\Data\Criterias\MobileCriteria;
use App\Containers\Banner\Data\Repositories\BannerRepository;
use App\Containers\Localization\Models\Language;
use App\Ship\Parents\Tasks\Task;

class GetAvailableBannerByPositionTask extends Task
{

    protected $repository;

    public function __construct(BannerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $positions = [], Language $currentLang, ?int $limit = 0): ?iterable
    {
        $this->currentLang = $currentLang->language_id ?? 1;

        $result = $this->repository->with(['desc' => function ($q) {
            $q->activeLang($this->currentLang);
        }]);
        if (isset($positions['pos']) && isset($positions['categoryIds'])) {
            $result->available($positions['pos']);
            $result->whereIn('category_id', $positions['categoryIds']);
        } else {
            // $result->available($positions);
            $result->whereIn('position', $positions);
        }
        $result->where('status', '>', 1);


        return $limit > 0 ? $result->limit($limit) : $result->get();
    }

    public function mobile(bool $isMobile = false)
    {
        $this->repository->pushCriteria(new MobileCriteria($isMobile));
    }
}
