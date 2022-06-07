<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-08-10 15:16:16
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-09-30 17:47:00
 * @ Description: Happy Coding!
 */

namespace Apiato\Core\Abstracts\Tasks;

use Apiato\Core\Interfaces\ITask;
use Apiato\Core\Traits\CacheableGlobalTrait;
use Apiato\Core\Traits\HasRequestCriteriaTrait;

/**
 * Class Task.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class Task implements ITask
{
    use HasRequestCriteriaTrait;
    use CacheableGlobalTrait;
}
