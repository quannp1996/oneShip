<?php 
namespace App\Containers\User\Traits;

use Illuminate\Support\Carbon;

trait UserStatusTrait {
    protected $checkOnlineTime = 1800;
    protected $statusCode = -1000;

    public function getStatusOpt(){
        return config('user-container.status-text');
    }

    public function getStatus()
    {
        if ($this->statusCode == -1000) {
            $this->statusCode = config('user-container.user_status_pending');
            switch ($this->status) {
                case -1:
                    $this->statusCode = config('user-container.user_status_removed');
                    break;
                case 0:
                    $this->statusCode = config('user-container.user_status_banned');
                    break;
                default:
                    if ($this->active > 0) {
                        if (empty($this->last_login)) {
                            $this->statusCode = config('user-container.user_status_not_login');
                        } else {
                            $this->statusCode = $this->isOnline() ? config('user-container.user_status_online') : config('user-container.user_status_offline');
                        }
                    }
            }
        }
        return $this->statusCode;
    }

    public function getStatusText()
    {
        $statusArray = config('user-container.status-text');
        return $statusArray[$this->getStatus()];
    }

    public function getStatusClass()
    {
        $status = $this->getStatus();
        switch ($status) {
            case config('user-container.user_status_removed'):
            case config('user-container.user_status_banned'):
                return 'danger';
            case config('user-container.user_status_pending'):
            case config('user-container.user_status_not_login'):
                return 'warning';
            case config('user-container.user_status_actived'):
            case config('user-container.user_status_online'):
                return 'success';
            case config('user-container.user_status_offline'):
                return 'secondary';
        }
    }

    public function isOnline(){
        $check_online_time = Carbon::createFromTimestamp(time() - $this->checkOnlineTime);
        return $check_online_time->lessThanOrEqualTo($this->last_active);
    }

    public function isRemoved(){
        return $this->status == config('user-container.user_status_removed');
    }
}