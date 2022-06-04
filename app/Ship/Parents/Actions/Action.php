<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-10 15:16:16
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-10 17:42:30
 * @ Description: Happy Coding!
 */

namespace App\Ship\Parents\Actions;

use Illuminate\Contracts\Cache\Repository;
use Illuminate\Config\Repository as ConfigRepository;
use Apiato\Core\Abstracts\Actions\Action as AbstractAction;

abstract class Action extends AbstractAction
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
