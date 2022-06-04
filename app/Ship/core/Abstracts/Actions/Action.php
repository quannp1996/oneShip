<?php

/**
 * @ Created by: VSCode
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-07 22:26:15
 * @ Description: Happy Coding!
 */

namespace Apiato\Core\Abstracts\Actions;

use Apiato\Core\Interfaces\ITask;
use Apiato\Core\Traits\CacheableGlobalTrait;
use Apiato\Core\Traits\CallableTrait;
use Apiato\Core\Traits\HasRequestCriteriaTrait;

/**
 * Class Action.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class Action
{

    use CallableTrait;
    use HasRequestCriteriaTrait;
    use CacheableGlobalTrait;

    protected $customCacheKey = null;
    protected $skipCache = false;

    /**
     * Set automatically by the controller after calling an Action.
     * Allows the Action to know which UI invoke it, to modify it's behaviour based on it, when needed.
     *
     * @var string
     */
    protected $ui;

    /**
     * @param $interface
     *
     * @return  $this
     */
    public function setUI($interface)
    {
        $this->ui = $interface;

        return $this;
    }

    /**
     * @return  mixed
     */
    public function getUI()
    {
        return $this->ui;
    }

    public function skipCache(bool $skipCache = true): self
    {
        $this->skipCache = $skipCache;
        return $this;
    }

    public function detectTaskCriteriaFunc(?array $filters, ITask $task): ITask
    {
        foreach ($filters as $funcName => $args) {
            // Key truyền vào là 1 chuỗi thể hiện cho tên func cần gọi
            if(is_string($funcName)) {
                // Gọi func với args được truyền vào dạng mảng
                call_user_func_array([$task, $funcName], $args);
            }else {
                // Gọi func với args mặc định của func đó
                call_user_func_array([$task, $args], []);
            }
        }

        return $task;
    }
}
