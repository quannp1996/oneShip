<?php

namespace App\Containers\User\Tasks;

use Exception;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Route;
use App\Containers\User\Models\UserLog;
use Apiato\Core\Foundation\Facades\FunctionLib;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Containers\User\Data\Repositories\UserLogRepository;
use Detection\MobileDetect as DetectionMobileDetect;

/**
 * Class CreateUserLogTask.
 *
 * @author Ha Ly Manh <halymanh@vccorp.com>
 */
class CreateUserLogTask extends Task
{
    protected $repository;

    public function __construct(UserLogRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param   int        $object_id
     * @param              $before
     * @param              $after
     * @param   string     $note
     *
     * @return  UserLog
     * @throws  CreateResourceFailedException
     */
    public function run(
        int $object_id = 0,
        $before = null,
        $after = null,
        string $note = '',
        string $model
    ): UserLog {

        try {
            $mobileDetect = new DetectionMobileDetect();
            $isMobile = $mobileDetect->isMobile();

            if(empty($before)) {
                $before = [];
            }elseif (is_object($before)) {
                $before = $before->toArray();
            }
            if(empty($after)) {
                $after = [];
            }elseif (is_object($after)) {
                $after = $after->toArray();
            }

            // create new user log
            $dataLog = [
                'object_id' => $object_id,
                'user_id' => \Auth::id(),
                'action' => Route::currentRouteName(),
                'ip' => FunctionLib::get_client_ip(),
                'url' => url()->full(),
                'env' => FunctionLib::appEnv(),
                'device' => $isMobile ? 1 : 0,
                'note' => $note,
                'model' => $model,
                'before' => json_encode($before, JSON_UNESCAPED_UNICODE),
                'after' => json_encode($after, JSON_UNESCAPED_UNICODE)
            ];
            $log = $this->repository->create($dataLog);
        } catch (Exception $e) {
            throw $e;
        }

        return $log;
    }

    public function isJsonStr($string){
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}
