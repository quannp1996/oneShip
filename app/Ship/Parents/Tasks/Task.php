<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-10 15:16:16
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-20 16:53:41
 * @ Description: Happy Coding!
 */

namespace App\Ship\Parents\Tasks;

use Apiato\Core\Abstracts\Tasks\Task as AbstractTask;
use Apiato\Core\Traits\FilterFields;
use App\Containers\Localization\Models\Language;
use App\Ship\Criterias\Eloquent\MustHaveDescCriteria;
use App\Ship\Criterias\Eloquent\OrderByFieldCriteria;
use App\Ship\Criterias\Eloquent\SelectFieldsCriteria;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;
use App\Ship\Criterias\Eloquent\WhereColumnCriteria;
use App\Ship\Criterias\Eloquent\WithCriteria;
use Illuminate\Cache\Repository;
use Illuminate\Config\Repository as ConfigRepository;

abstract class Task extends AbstractTask
{
    use FilterFields;
    public $currentLang, $skipPagin = false;
    protected $externalWith = [];
    protected $mustHaveDesc;

    public function __construct()
    {
        $this->cache = app(Repository::class);
        $this->cacheTime = app(ConfigRepository::class)->get('cache.repo_time', 60);
        $this->locale = app()->getLocale();
        $this->enableCache = env('APP_ACTION_CACHE', false);
    }

    public function currentLang(Language $currentLang): self
    {
        $this->currentLang = $currentLang;
        return $this;
    }

    public function skipPagin(): self
    {
        $this->skipPagin = true;
        return $this;
    }

    public function with(array $with = []): self
    {
        $this->repository->pushCriteria(new WithCriteria($with, $this->externalWith));
        return $this;
    }

    // Có thể nhồi \Closure vào đây để tránh phải exclude param khi gen cache key
    public function externalWith(array $external): self
    {
        $this->externalWith = $external;
        return $this;
    }

    public function mustHaveDescByLang(): self
    {
        $this->repository->pushCriteria(new MustHaveDescCriteria($this->currentLang->language_id));
        return $this;
    }

    public function activeStatus(int $status): self
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria('status', $status));
        return $this;
    }

    /*extra criteria*/
    public function orderBy(array $orderBy)
    {
        if (!empty($orderBy) && is_array($orderBy) && count($orderBy) > 1) {
            foreach ($orderBy as $column => $direction) {
                $this->repository->pushCriteria(new OrderByFieldCriteria($column, $direction));
            }
        } else {
            $orderByField = key($orderBy);
            $orderByValue = $orderBy[$orderByField];
            $this->repository->pushCriteria(new OrderByFieldCriteria($orderByField, $orderByValue));
        }
        return $this;
    }

    public function where(array $where = [])
    {
        $this->repository->pushCriteria(new WhereColumnCriteria($where));
        return $this;
    }

    public function selectFields(array $column = [])
    {
        $this->repository->pushCriteria(new SelectFieldsCriteria($column));
        return $this;
    }
}
