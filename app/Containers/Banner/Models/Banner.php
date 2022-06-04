<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2020-10-04 13:58:15
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-10 16:23:34
 * @ Description:
 */

namespace App\Containers\Banner\Models;

use Apiato\Core\Foundation\ImageURL;
use Apiato\Core\Foundation\StringLib;
use App\Containers\Banner\Enums\BannerStatus;
use Jenssegers\Mongodb\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banner';
    protected $appends = ['id'];
    protected $fillable = [
        'status',
        'sort_order',
        'position',
        'is_mobile',
        'publish_at',
        'end_at',
        'category_id'
    ];

    const SIZE = [
        'big_home' => ['width' => 1920, 'height' => 0],
        'big_news' => ['width' => 1920, 'height' => 0],
        'big_product' => ['width' => 1920, 'height' => 0],
        // 'fae_home' => ['width' => 600, 'height' => 398],
    ];

    public static function getSize($type = 'big_home')
    {
        if (isset(self::SIZE[$type])) {
            return (object)self::SIZE[$type];
        }
        return false;
    }

    public function positions()
    {

        $configPositions = config('banner-container.positions');
        $all = explode(',', $this->position);
        if (!empty($all)) {
            $tmp = [];
            foreach ($all as $a) {
                if (isset($configPositions[$a])) {
                    $tmp[$a] = $configPositions[$a];
                }
            }
            return $tmp;
        }
        return false;
    }

    public function desc()
    {
        return $this->hasOne(BannerDesc::class, 'banner_id', 'id');
    }

    public function all_desc()
    {
        return $this->hasMany( BannerDesc::class, 'banner_id', 'id');
    }

    public function scopeAvailable($query, array $positions = [])
    {
        return $query->where('status', BannerStatus::ACTIVE)
            ->where(function ($query) use ($positions) {
                foreach ($positions as $position) {
                    $query->orWhereRaw("LOCATE('{$position}', position) > 0");
                }
            });
    }

    public function getImageUrl($size = '')
    {
        return ImageURL::getImageUrl($this->desc->image, 'banner', $size);
    }

    public function getBannerLink(): string
    {
        if (!empty($this->desc->link)) {
            return $this->desc->link;
        }

        return route('web.home.index');
    }

    public function buildListItem(string $tag = 'p'){
        return StringLib::splitStringByTag($tag, $this->desc->short_description);
    }
}
