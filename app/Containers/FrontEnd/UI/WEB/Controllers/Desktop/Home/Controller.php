<?php

namespace App\Containers\FrontEnd\UI\WEB\Controllers\Desktop\Home;

use App\Containers\Banner\Models\Banner;
use App\Containers\BaseContainer\Enums\BaseEnum;
use App\Containers\BaseContainer\UI\WEB\Controllers\BaseFrontEndController;
use App\Containers\Field\Actions\GetAllFieldsAction;
use App\Containers\StaticPage\Actions\FrontEnd\GetAvailablePageByPositionAction;
use App\Containers\StaticPage\Actions\ListStaticPageAction;
use Illuminate\Support\Facades\DB;

class Controller extends BaseFrontEndController
{

    public function index(GetAvailablePageByPositionAction $getAvailablePageByPositionAction)
    {
        $banner = Banner::select('*')
                ->where('status', 2)
                ->orWhere('status', '2')
                ->where('position', 'big_home')
                ->orderBy('sort_order', 'asc')
                ->with(['desc'])
                ->first();
        $fields = app(GetAllFieldsAction::class)->run([
            'status' => "1"
        ]);
        $staticPage = app(ListStaticPageAction::class)->run([]);
        $this->generateMetaTag(null,  __('site.trangchu'));
        return $this->returnView('frontend', 'home.index', [
            'banner' => $banner,
            'fields' => $fields,
            'staticPage' => $staticPage->isNotEmpty() ? $staticPage->first() : null,
        ]);
    }
    public function thankyou(GetAvailablePageByPositionAction $getAvailablePageByPositionAction)
    {
        $banner = Banner::select('*')
                ->where('status', BaseEnum::ACTIVE)
                ->where('position', 'thankyou')
                ->orderBy('sort_order', 'asc')
                ->with(['desc'])
                ->first();
        $fields = app(GetAllFieldsAction::class)->run([
            'status' => "1"
        ]);
        $staticPage = app(ListStaticPageAction::class)->run([]);
        $this->generateMetaTag(null,  __('site.trangchu'));
        return $this->returnView('frontend', 'home.thankyou', [
            'banner' => $banner,
            'fields' => $fields,
            'staticPage' => $staticPage->isNotEmpty() ? $staticPage->first() : null,
        ]);
    }
}
