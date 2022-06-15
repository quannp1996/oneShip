<?php

namespace App\Containers\Location\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Location extends Model
{
    public function listDisabled(){
        if($this->disabled && !is_array($this->disabled)) return json_decode($this->disabled, true);
        return [];
    }
}
