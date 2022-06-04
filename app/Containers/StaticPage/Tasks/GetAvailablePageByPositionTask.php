<?php

namespace App\Containers\StaticPage\Tasks;

use App\Containers\Localization\Models\Language;
use App\Containers\StaticPage\Data\Repositories\StaticPageRepository;
use App\Ship\Parents\Tasks\Task;

class GetAvailablePageByPositionTask extends Task
{
    protected $repository;

    public function __construct(StaticPageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $positions = [], Language $currentLang = null,$limit = 0)
    {
        $language_id = $currentLang->language_id ?? 1;

        $data = $this->repository->with([
                'desc' => function ($query) use ($language_id) {
                    $query->where('language_id', $language_id);
                },
            ]
        )->available($positions);
        return $limit == 0 ? $data->first() : $data->get();
    }
}
