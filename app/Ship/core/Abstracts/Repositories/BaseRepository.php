<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-10 15:16:16
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-24 13:44:59
 * @ Description: Happy Coding!
 */

namespace Apiato\Core\Abstracts\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository as EloquentBaseRepository;

abstract class BaseRepository extends EloquentBaseRepository
{
    /**
     * Update nhiều bản ghi cùng 1 lúc
     * [
     *      'id' => [
     *          'column' => 'value',
     *          'column' => 'value'
     *       ]
     * ]
     * @var directReplace Replace trực tiếp tham số vào câu query (Trường hợp nào đảm bảo toàn vẹn + bảo mật mới đc phép dùng)
     */
    public function updateMultiple(array $values, string $key = 'id', bool $with_update_date = false, bool $directReplace = false)
    {
        $table = $this->model->getTable();
        $ids = [];
        $params = [];
        $columnsGroups = [];
        $queryStart = "UPDATE {$table} SET";
        $columnsNames = array_keys(array_values($values)[0]);
        foreach ($columnsNames as $columnName) {
            $cases = [];
            $columnGroup = " " . $columnName . " = CASE $key ";
            foreach ($values as $id => $newData) {
                $cases[] = $directReplace ? "WHEN {$id} then " . $newData[$columnName] : "WHEN {$id} then ? ";
                $directReplace ? false : $params[] = $newData[$columnName];
                $ids[$id] = "0";
            }
            $cases = implode(' ', $cases);
            $columnsGroups[] = $columnGroup . "{$cases} END";
        }
        $ids = implode(',', array_keys($ids));
        $columnsGroups = implode(',', $columnsGroups);
        $params[] = Carbon::createFromTimestamp(time());
        $queryEnd = ($with_update_date ? ', updated_at = ?' : '') . " WHERE $key in ({$ids})";
        // DB::enableQueryLog();
        return DB::update($queryStart . $columnsGroups . $queryEnd, $params);
        // dd(DB::getQueryLog());
    }

    public function updateMultipleConditions(array $values, $conds = ['option_value_id', 'language_id'], $with_update_date = false,bool $directReplace = false)
    {
        $table = $this->model->getTable();
        $ids = [];
        $params = [];
        $columnsGroups = [];
        $queryStart = "UPDATE {$table} SET";

        $columnsNames = array_keys(array_values($values['data'])[0]);

        $str_where_dlobal = '';
        foreach ($columnsNames as $columnName) {
            $cases = [];
            $columnGroup = " " . $columnName . " = CASE ";
            foreach ($values['data'] as $id => $newData) {

                $str_case = "WHEN ";

                $fist_key = array_key_first($values['conds'][$id]);
                $last_key = array_key_last($values['conds'][$id]);
                foreach ($values['conds'][$id] as $k_cond => $v_cond) {
                    $str_case .= ($fist_key == $k_cond ? ' ( ' : '') . " $k_cond = $v_cond " . ($last_key != $k_cond ? ' AND ' : '') . ($last_key == $k_cond ? ' ) ' : '');
                    $str_where_dlobal .= ($fist_key == $k_cond ? ' ( ' : '') . " $k_cond = $v_cond " . ($last_key != $k_cond ? ' AND ' : '') . ($last_key == $k_cond ? ' ) OR ' : '');
                }
                $str_case .= $directReplace ? "then ".$newData[$columnName] : "then ?";

                $cases[] = $str_case;

                $directReplace ? false : $params[] = $newData[$columnName];
            }
            $cases = implode(' ', $cases);
            $columnsGroups[] = $columnGroup . "{$cases} END";
        }

        $columnsGroups = implode(',', $columnsGroups);
        if ($with_update_date) {
            $params[] = Carbon::createFromTimestamp(time());
        }
        $queryEnd = ($with_update_date ? ', updated_at = ?' : '') . " WHERE " . str_replace(' OR ___', '', $str_where_dlobal . '___');
        // DB::enableQueryLog();
        return \DB::update($queryStart . $columnsGroups . $queryEnd, $params);
        // dd(DB::getQueryLog());
    }
}
