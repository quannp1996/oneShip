<?php
/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2020-10-04 13:58:49
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2020-10-04 16:14:07
 * @ Description:
 */

namespace App\Containers\Banner\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Apiato\Core\Foundation\Facades\ImageURL;
use App\Containers\Localization\Models\Language;
class BannerDesc extends Model {
    protected $table = 'banner_description';
    protected $appends = ['id'];
    protected $fillable = [
        'banner_id',
        'language_id',
        'name',
        'short_description',
        'link',
        'image'
    ];

    public function language()
    {
        return $this->hasOne(Language::class,'language_id','language_id');
    }

    public function getImageUrl($size = 'original'){
        return ImageURL::getImageUrl($this->image, 'banner', $size);
    }
}