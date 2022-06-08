<?php

namespace App\Ship\Parents\Models;

use Apiato\Core\Abstracts\Models\Model as AbstractModel;
use Apiato\Core\Traits\HashIdTrait;
use Apiato\Core\Traits\HasManyKeyBy;
use Apiato\Core\Traits\HasResourceKeyTrait;
use Apiato\Core\Traits\InsertOnDuplicateKey;
use Illuminate\Support\Facades\DB as FacadesDB;

/**
 * Class Model.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class Model extends AbstractModel
{

    use HashIdTrait;
    use HasResourceKeyTrait;
    use InsertOnDuplicateKey, HasManyKeyBy;

    /**
     * query scope nPerGroup
     *
     * @return void
     */
    public function scopeNPerGroup($query, $group, $n = 10, $extra_conds = [])
    {
        // queried table
        $table = ($this->getTable());

        // initialize MySQL variables inline
        $query->from(FacadesDB::raw("(SELECT @rank:=0, @group:=0) as vars, {$table}"));

        // if no columns already selected, let's select *
        if (!$query->getQuery()->columns) {
            $query->select("{$table}.*");
        }

        // make sure column aliases are unique
        $groupAlias = 'group_' . md5(time());
        $rankAlias  = 'rank_' . md5(time());

        // apply mysql variables
        $query->addSelect(FacadesDB::raw(
            "@rank := IF(@group = {$group}, @rank+1, 1) as {$rankAlias}, @group := {$group} as {$groupAlias}"
        ));

        // make sure first order clause is the group order
        $query->getQuery()->orders = (array) $query->getQuery()->orders;
        array_unshift($query->getQuery()->orders, ['column' => $group, 'direction' => 'asc']);

        // prepare subquery
        $subQuery = $query->toSql();

        // prepare new main base Query\Builder
        $newBase = $this->newQuery()
            ->from(FacadesDB::raw("({$subQuery}) as {$table}"))
            ->mergeBindings($query->getQuery())
            // ->limit($n)
            ->where($rankAlias, '<=', $n)
            ->where($extra_conds)
            ->getQuery();

        // dd($newBase->toSql());
        // replace underlying builder to get rid of previous clauses
        $query->setQuery($newBase);
    }

    public function scopeActiveLang($query, int $language_id = 1)
    {
        return $query->whereHas('language', function ($q) use ($language_id) {
            $q->where('language_id', $language_id);
        });
    }

    public function scopeMustHaveDesc($query, int $language_id)
    {
        return $query->whereHas('desc', function ($q) use ($language_id) {
            $q->where('language_id', $language_id);
            $q->whereNotNull('name');
            $q->where('name', '!=', '');
        });
    }
}
