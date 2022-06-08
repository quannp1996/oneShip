<?php

namespace App\Ship\Parents\Actions;

use Apiato\Core\Abstracts\Actions\SubAction as AbstractSubAction;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Config\Repository as ConfigRepository;

/**
 * Class SubAction.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class SubAction extends AbstractSubAction
{
    protected $externalWith = [];

    public function __construct()
    {
        $this->cache = app(Repository::class);
        $this->cacheTime = app(ConfigRepository::class)->get('cache.action', 60);
        $this->locale = app()->getLocale();
        $this->enableCache = env('APP_ACTION_CACHE', false);
    }
}
