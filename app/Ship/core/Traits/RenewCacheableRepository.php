<?php
/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-02-12 14:07:01
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-02-12 15:29:52
 * @ Description: Happy Coding!
 */


namespace Apiato\Core\Traits;

use Prettus\Repository\Traits\CacheableRepository;
use Illuminate\Contracts\Cache\Repository as CacheRepository;
use Prettus\Repository\Contracts\CriteriaInterface;
use ReflectionObject;
use Exception;

trait RenewCacheableRepository
{
    protected $cacheRepository = null;

    use CacheableRepository {
        setCacheRepository as public parentSetCacheRepository;
        getCacheRepository as public parentGetCacheRepository;
        skipCache as public parentSkipCache;
        isSkippedCache as public parentisSkippedCache;
        allowedCache as protected parentallowedCache;
        getCacheKey as public parentgetCacheKey;
        serializeCriteria as protected parentserializeCriteria;
        all as public parentall;
        paginate as public parentpaginate;
        find as public parentfind;
        findByField as public parentfindByField;
        findWhere as public parentfindWhere;
        getByCriteria as public parentgetByCriteria;
        serializeCriterion as protected parentSerializeCriterion;
    }

    public function setCacheRepository(CacheRepository $repository)
    {
        return $this->parentSetCacheRepository($repository);
    }

     public function getCacheRepository()
    {
        return $this->parentGetCacheRepository();
    }

    public function skipCache($status = true) {
        return $this->parentSkipCache($status);
    }

    public function isSkippedCache() {
        return $this->parentisSkippedCache();
    }

    protected function allowedCache($method) {
        return $this->parentallowedCache($method);
    }

    public function getCacheKey($method, $args = null) {
        return $this->parentgetCacheKey($method, $args = null);
    }

    protected function serializeCriteria(){
        return $this->parentserializeCriteria();
    }


    protected function serializeCriterion($criterion) {
        try {
            serialize($criterion);

            return $criterion;
        } catch (Exception $e) {
            // We want to take care of the closure serialization errors,
            // other than that we will simply re-throw the exception.
            if ($e->getMessage() !== "Serialization of 'Closure' is not allowed") {
                // throw $e;
            }

            $r = new ReflectionObject($criterion);

            return [
                'hash' => md5((string) $r),
            ];
        }
    }

    public function getCacheMinutes() {
        return $this->parentgetCacheMinutes();
    }

    public function all($columns = ['*']) {
        return $this->parentall($columns);
    }

    public function paginate($limit = null, $columns = ['*'], $method = 'paginate') {
        return $this->parentpaginate($limit,$columns,$method);
    }

    public function find($id, $columns = ['*']) {
        return $this->parentfind($id,$columns);
    }

    public function findByField($field, $value = null, $columns = ['*']) {
        return $this->parentfindByField($field,$value,$columns);
    }

    public function findWhere(array $where, $columns = ['*']) {
        return $this->parentfindWhere($where,$columns);
    }

    public function getByCriteria(CriteriaInterface $criteria) {
        return $this->parentgetByCriteria($criteria);
    }
}
