<?php

namespace App\Containers\Localization\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class LanguageRepository
 */
class LanguageRepository extends Repository
{
    protected $cacheMinutes = 900;

    protected $cacheOnly = ['all']; // Chỉ cache phương thức all trong BaseRepo

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

}
