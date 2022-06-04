<?php

namespace App\Containers\Menu\Models;

use Apiato\Core\Traits\HasManyKeyBy;
use App\Ship\core\Traits\HelpersTraits\LangTrait;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Exception;

class Menu extends Model
{
    use SoftDeletes;
    use LangTrait, HasManyKeyBy;

    protected $table = 'menu';

    protected $guarded = [];

    protected $attributes = [];

    protected $hidden = [];

    protected $casts = [];


    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $appends = ['menu_link', 'id'];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'menus';

    public function all_desc()
    {
        return $this->hasMany(MenuDesc::class, 'menu_id', 'id');
    }
    
    public function all_desc_lang()
    {
        return $this->hasManyKeyBy('language_id', MenuDesc::class, 'menu_id', 'id');
    }

    public function childs()
    {
        return $this->hasMany(self::class, 'pid', 'id')->orderBy('sort_order', 'ASC');
    }

    public function childrens()
    {
        return $this->childs()->with('childrens.desc');
    }

    public function desc_lang()
    {
        return $this->hasOne(MenuDesc::class, 'menu_id', 'id');
    }

    public function desc()
    {
        return $this->hasOne(MenuDesc::class, 'menu_id', 'id');
    }

    public static function trimFirstNLastSlash($text)
    {
        if (empty($text)) return null;

        $text = ltrim($text, "/");
        return rtrim($text, "/");
    }

    public function getMenuLinkAttribute()
    {
        $locale = config('apiato.using_locale_segment') ? app()->getLocale() . '/' : null;
        if (!empty($this->extra_link)) {
            if (filter_var($this->extra_link, FILTER_VALIDATE_URL)) return ($this->extra_link);

            return url($locale . self::trimFirstNLastSlash($this->extra_link)) ?? '#';

        } else {
            try {
                if (Route::has($this->link)) return route($this->link);
            } catch (Exception $e) {
            }

            return $this->link ?? url($locale . self::trimFirstNLastSlash($this->extra_link)) ?? '#';
        }
    }

    public function isActiveMenu()
    {
        // web.thu-vien.index - https://thu-vien.dh-phuong-dong.local : currentRouteName + current ko có / ở cuối
        if (!empty($this->menu_link) && $this->menu_link !== '#') {
            if ($this->menu_link === Route::currentRouteName() || $this->menu_link === URL::current()) {
                return true;
            }
        }

        return false;
    }

    public function getActiveMenuClass()
    {
        if ($this->isActiveMenu()) {
            return 'active';
        }
        return '';
    }
} // End class
