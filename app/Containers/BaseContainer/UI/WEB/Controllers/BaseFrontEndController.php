<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-07-07 10:28:53
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-24 20:39:07
 * @ Description: Happy Coding!
 */

namespace App\Containers\BaseContainer\UI\WEB\Controllers;

use App\Containers\BaseContainer\UI\WEB\Controllers\Features\FrontBreabcrumb;
use App\Containers\Localization\Actions\GetCurrentLangAction;
use App\Containers\Menu\Actions\GetMenusByTypeAction;
use App\Containers\Settings\Actions\GetAllSettingsAction;
use App\Containers\ShoppingCart\Events\CartInitEvent;
use App\Ship\core\Traits\HelpersTraits\ApiResTrait;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Support\Facades\View;
use Apiato\Core\Foundation\StringLib;
use App\Containers\ShoppingCart\Actions\FrontEnd\GetContentCartAction;
use Illuminate\Support\Facades\Route;

class BaseFrontEndController extends WebController
{
    use FrontBreabcrumb;
    use ApiResTrait;

    protected $settings = [];
    protected $dataPassByMiddleware = [], $dataPassToView = [];
    protected $isMobile = false;
    protected $breadcrumb = [];
    public $currentLang;

    public function __construct()
    {
        $this->currentLang = app(GetCurrentLangAction::class)->run();

        $this->frontBreadcrumb(__('site.trangchu'), route('web.home.index'));

        $menus = app(GetMenusByTypeAction::class)->run(
            [
                config('menu-container.type_key.top_website'),
                config('menu-container.type_key.bottom_website'),
            ],
            false,
            $this->currentLang,
            [['status', '=', config('menu-container.status.visible')]]
        );
        $this->settings = app(GetAllSettingsAction::class)->run('Array', true, $this->currentLang);

        View::share([
            'settings' => $this->settings,
            'menus' => $menus,
            'currentLang' => $this->currentLang->short_code ?? app()->getLocale()
        ]);
        
    }

    public function returnView(string $container, $view = null, $data = [], $mergeData = [])
    {
        $viewPath = $container . '::' . ($this->isMobile ? config('frontend-container.mobile_alias') : config('frontend-container.desktop_alias')) . '.' . $view;

        return view($viewPath, $data, array_merge($this->dataPassByMiddleware, $this->dataPassToView, $mergeData));
    }

    protected function setSiteTitle($title = '', bool $extraSuffix = true)
    {
        $this->settings['website']['site_title'] = $title;

        View::share('site_title', $title);
    }

    protected function generateMetaTag($object = null, string $title = '', string $description = '', string $keyword = '', bool $extraSuffix = true)
    {
        $title = !empty($title) ? $title : (!empty($object->desc->meta_title) ? $object->desc->meta_title : (!empty($object->desc->name) ? $object->desc->name : ''));
        if (!empty($title)) {
            $this->setSiteTitle($title, $extraSuffix);
        }

        $description = !empty($description) ? $description : (!empty($object->desc->meta_description) ? $object->desc->meta_description : '');
        if (!empty($description)) {
            $this->settings['website']['description'] = $description;
        }

        $keyword = !empty($keyword) ? $keyword : (!empty($object->desc->meta_keyword) ? $object->desc->meta_keyword : '');
        if (!empty($keyword)) {
            $this->settings['website']['keywords'] = $keyword;
        }

            if (!empty($title) || !empty($description) || !empty($keyword)) {
            View::share('settings', $this->settings);
        }
    }
}
