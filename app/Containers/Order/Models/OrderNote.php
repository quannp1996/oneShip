<?php

namespace App\Containers\Order\Models;

use App\Containers\User\Models\User;
use App\Ship\core\Traits\HelpersTraits\DateTrait;
use App\Ship\Parents\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use function PHPSTORM_META\map;

class OrderNote extends Model
{
    use SoftDeletes;
    use DateTrait;

    protected $table = 'order_note';

    protected $fillable = [
      'title',
      'message',
      'color',
      'object_id',
      'order_id',
      'reason_key',
      'order_action'
    ];

    protected $attributes = [

    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'ordernotes';



    // public function user() {
    //   return $this->belongsTo(User::class, 'user_id', 'id');
    // }

 
} // End class
