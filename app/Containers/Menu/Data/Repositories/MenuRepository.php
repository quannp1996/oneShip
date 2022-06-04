<?php

namespace App\Containers\Menu\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;
use App\Ship\core\Traits\HelpersTraits\RecursiveTrait;
use Illuminate\Support\Arr;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * Class MenuRepository
 */
class MenuRepository extends Repository
{
    protected $cacheMinutes = 600;

    public $cacheOnly = ['getSidebarMenuTree']; // Chỉ cache phương thức all trong BaseRepo

    use RecursiveTrait;

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

    /**
     * Cache HTML Sidebar
     *
     * @param array $conditional ['column_name' => $column_value]
     * @param array $data
     * @return void
     */
    public function getSidebarMenuTree(int $type, array $with=[]) {
        if (!$this->allowedCache('getSidebarMenuTree') || $this->isSkippedCache()) {
            return $this->hanldeTreeSidebar($type, $with);
        }

        $key = $this->getCacheKey('getSidebarMenuTree', func_get_args());
        $keyArray = explode('-', $key);
        $originalKey = Arr::first($keyArray);

        $minutes = $this->getCacheMinutes();
        $value = $this->getCacheRepository()->remember($originalKey, $minutes, function () use ($type, $with) {
            return $this->hanldeTreeSidebar($type, $with);
        });

        $this->resetModel();
        $this->resetScope();
        return $value;
    }

    public function hanldeTreeSidebar($type, $with) {
        $menus = $this->with($with)
            ->scopeQuery(function ($query) {
                return $query->orderBy('sort_order', 'ASC');
            })
            ->findWhere([
                ['type', '=', (string) $type],
                ['status', '=', (string) config('menu-container.status.visible')]
            ]);
        $menusArray = $menus->toArray();
        $treeData = $this->buildTree($menusArray);
        $treeSideBar = $this->buildNestableSidebar($treeData);
        return $this->parserResult($treeSideBar);
    }
}
