<?php

namespace App\Containers\Settings\UI\WEB\Controllers\Admin;

use Apiato\Core\Foundation\Facades\Apiato;
use Apiato\Core\Foundation\Facades\FunctionLib;
use Apiato\Core\Foundation\StringLib;
use App\Containers\Settings\Models\Setting;
use App\Containers\Settings\UI\WEB\Requests\EditSettingsRequest;
use App\Containers\Settings\UI\WEB\Requests\GetAllSettingsRequest;
use App\Ship\Parents\Controllers\AdminController;
use App\Ship\Transporters\DataTransporter;
use Exception;
use Illuminate\Support\Facades\View;

class Controller extends AdminController
{
    public function __construct()
    {
        $this->title = 'Cấu hình website';
        parent::__construct();
    }

    public function index(GetAllSettingsRequest $request)
    {
        $this->breadcrumb[] = FunctionLib::addBreadcrumb('Cấu hình', $this->form == 'list' ? '' : route('admin_settings_edit_page'));
        View::share('breadcrumb', $this->breadcrumb);
        $settings = Apiato::call('Settings@GetAllSettingsAction', ['Array', true]);
        // dd($settings);
        return view('settings::admin.settings.index', [
            'search_data' => $request,
            'data' => $settings,
        ]);
    }

    public function edit(EditSettingsRequest $request)
    {
        try {
            $transporter = new DataTransporter($request);
            $website = isset($transporter['website']) ? $transporter['website'] : new DataTransporter();
            if (isset($request->website['image_seo'])) {
                $image = Apiato::call('File@UploadImageAction', [$request, 'website.image_seo', 'website-seo-img-', StringLib::getClassNameFromString(Setting::class)]);
                if (!$image['error']) {
                    $website->image_seo = $image['fileName'];
                }
            }

            if (isset($request->website['logo'])) {
                $image = Apiato::call('File@UploadImageAction', [$request, 'website.logo', 'website-logo-img-', StringLib::getClassNameFromString(Setting::class)]);
                if (!$image['error']) {
                    $website->logo = $image['fileName'];
                }
            }

            if (isset($request->website['logo_footer'])) {
                $image = Apiato::call('File@UploadImageAction', [$request, 'website.logo_footer', 'website-logo-footer-img-', StringLib::getClassNameFromString(Setting::class)]);
                if (!$image['error']) {
                    $website->logo_footer = $image['fileName'];
                }
            }

            if (isset($request->website['favicon'])) {
                $image = Apiato::call('File@UploadImageAction', [$request, 'website.favicon', 'website-favicon-img-', StringLib::getClassNameFromString(Setting::class)]);
                if (!$image['error']) {
                    $website->favicon = $image['fileName'];
                }
            }


            $website->mobile_active = isset($request->website['mobile_active']) ? 1 : 0;
            $website->down_for_constructions = isset($request->website['down_for_constructions']) ? 1 : 0;
            $website->go_production = isset($request->website['go_production']) ? 1 : 0;

            $transporter->website = $website;

            Apiato::call('Settings@UpdateSettingAction', [$transporter]);

            return redirect()->route('admin_settings_edit_page')->with('status', 'Cấu hình đã được cập nhật');
        } catch (Exception $e) {
            throw $e;
            $this->throwExceptionViaMess($e);
        }
    }
}
