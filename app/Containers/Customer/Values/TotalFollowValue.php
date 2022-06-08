<?php

namespace App\Containers\Customer\Values;

use App\Ship\Parents\Values\Value;
use App\Containers\Customer\Models\CustomerFollow;

class TotalFollowValue extends Value
{
    public $follow;

    public $total_follow;

    public $status;

    public $message;

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'totalfollowvalues';

    public function __construct($follow, int $totalFollow)
    {
        $this->follow = $follow;
        $this->total_follow = $totalFollow;

        if ($this->follow instanceof CustomerFollow) {
            $this->status = 'attach';
            $this->message = __('Theo dõi thành công');
        }else {
            $this->status = 'detach';
            $this->message = __('Hủy theo dõi thành công');
        }
    }
}   
