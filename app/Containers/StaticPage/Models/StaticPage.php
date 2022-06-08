<?php
/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2020-10-04 13:58:15
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2020-10-21 14:34:21
 * @ Description:
 */

namespace App\Containers\StaticPage\Models;

use Apiato\Core\Foundation\Facades\ImageURL;
use Apiato\Core\Foundation\StringLib;
use App\Containers\Banner\Enums\BannerStatus;
use App\Ship\core\Traits\HelpersTraits\LangTrait;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Support\Str;

class StaticPage extends Model
{
    use LangTrait;
    protected $table = 'static_page';
    protected $appends = ['id'];
    protected $fillable = [
        'status',
        'sort_order',
        'image',
        'position',
        'images',
        'image_seo',
        'view_type',
        'staticpage_content'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function desc()
    {
        return $this->hasOne(StaticPageDesc::class, 'static_page_id', 'id');
    }

    public function all_desc()
    {
        return $this->hasMany(StaticPageDesc::class, 'static_page_id', 'id');
    }

    /*func*/
    public function positions()
    {
        $positions = config('page-container.positions');

        if (!empty($positions)) {
            $all = explode(',', $this->position);
            if (!empty($all)) {
                $tmp = [];
                foreach ($all as $a) {
                    if (isset($positions[$a])) {
                        $tmp[$a] = $positions[$a];
                    }
                }
                return $tmp;
            }
        }
        return false;
    }

    public function getLink()
    {
        if(!empty($this->desc->name) && !empty($this->id))
        {
            if(!empty($this->desc->link)){
                return $this->desc->link ;
            }
             return route('web.page.detail', ['slug' => Str::slug($this->desc->name), 'id' => $this->id]);
        }
    }


    public function getImageUrl($size = 'original')
    {
        return ImageURL::getImageUrl($this->image, 'staticpage', $size);
    }

    public function lang()
    {
        $lang = config('app.locales');
        return isset($lang[$this->lang]) ? $lang[$this->lang] : 'vi';
    }

    /*scope*/
    public function scopeAvailable($query, array $positions = [])
    {
        return $query->where('status', BannerStatus::ACTIVE)
            ->where(function ($query) use ($positions) {
                foreach ($positions as $position) {
                    $query->orWhereRaw("LOCATE('{$position}', position) > 0");
                }
            });
    }

    public function buildItems(bool $json = false){
        if($this->relationLoaded('desc')){
            if(!$json) return json_decode($this->desc->item);
            $items = json_decode($this->desc->item);
            foreach($items AS &$item){
                $item->image = asset('upload/staticpage/' . $item->item_image);
            }
            return json_encode($items);
        }
        return [];
    }

    public function scopeActiveLang($query, int $language_id = 1)
    {
        return $query->whereHas('language', function ($q) use ($language_id) {
            $q->where('language_id', $language_id);
        });
    }

    public function splitDesc($desc){
        return StringLib::splitStringByTag('p', $desc);
    }
}
