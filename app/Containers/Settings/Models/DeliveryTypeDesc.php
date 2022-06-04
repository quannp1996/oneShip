<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2020-10-04 13:58:49
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-18 12:08:10
 * @ Description:
 */

namespace App\Containers\Settings\Models;

use App\Ship\Parents\Models\Model;
use Apiato\Core\Foundation\Facades\ImageURL;
use App\Containers\Localization\Models\Language;

class DeliveryTypeDesc extends Model
{
    protected $table = 'delivery_type_description';
    protected $fillable = [
        'delivery_type_id',
        'language_id',
        'name',
        'short_description',
        'link',
        'image'
    ];

    public function language()
    {
        return $this->hasOne(Language::class, 'language_id', 'language_id');
    }

    public function getImageUrl($size = 'original')
    {
        return ImageURL::getImageUrl($this->image, 'settings', $size);
    }
}
