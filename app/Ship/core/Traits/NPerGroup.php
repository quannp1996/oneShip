<?php
/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2020-10-07 14:25:57
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-01-31 18:01:20
 * @ Description: Happy Coding!
 */

namespace Apiato\Core\Traits;

use DB;

trait NPerGroup
{

    public function scopeNPerGroup($query, $group, $n = 10)
    {
        // queried table
        $table = ($this->getTable());

        // initialize MySQL variables inline
        $query->from( DB::raw("(SELECT @rank:=0, @group:=0) as vars, {$table}") );

        // if no columns already selected, let's select *
        if ( ! $query->getQuery()->columns)
        {
            $query->select("{$table}.*");
        }

        // make sure column aliases are unique
        $groupAlias = 'group_'.md5(time());
        $rankAlias  = 'rank_'.md5(time());

        // apply mysql variables
        $query->addSelect(DB::raw(
            "@rank := IF(@group = {$group}, @rank+1, 1) as {$rankAlias}, @group := {$group} as {$groupAlias}"
        ));

        // make sure first order clause is the group order
        $query->getQuery()->orders = (array) $query->getQuery()->orders;
        array_unshift($query->getQuery()->orders, ['column' => $group, 'direction' => 'asc']);

        // prepare subquery
        $subQuery = $query->toSql();

        // prepare new main base Query\Builder
        $newBase = $this->newQuery()
            ->from(DB::raw("({$subQuery}) as {$table}"))
            ->mergeBindings($query->getQuery())
            ->where($rankAlias, '<=', $n)
            ->getQuery();

        // replace underlying builder to get rid of previous clauses
        $query->setQuery($newBase);
    }
}
