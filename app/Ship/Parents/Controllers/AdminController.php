<?php

namespace App\Ship\Parents\Controllers;

use Apiato\Core\Abstracts\Controllers\WebController as AbstractWebController;
use Apiato\Core\Foundation\Facades\Apiato;
use Apiato\Core\Foundation\Facades\FunctionLib;
use Apiato\Core\Traits\ResponseTrait;
use App\Ship\core\Foundation\BladeHelper;
use App\Ship\core\Traits\HelpersTraits\ApiResTrait;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

/**
 * Class AdminController.
 */
abstract class AdminController extends AbstractWebController
{
    use ResponseTrait, ApiResTrait;

    public $title = '', $form = '', $user = null;
    public $breadcrumb = [];
    protected $editMode = false;
    protected $perPage = 10;
    protected $currentLang;
    protected $dontUseShareData = false;

    //new way to save code
    protected $imageField = 'image';
    protected $fileField = 'file';
    protected $imageKey;
    protected $actions;
    protected $routes;

    public function __construct()
    {
        $this->breadcrumb[] = FunctionLib::addBreadcrumb();
        $this->currentLang = app()->getLocale();

        View::share('site_title', 'Quản trị ' . $this->title);
        View::share('currentLang', $this->currentLang);
        if (!$this->dontUseShareData) {
            View::share('sidebarMenus', Apiato::call('Menu@GetMenusByTypeAction', [config('menu-container.type_key.sidebar_admin'), true]));

            View::share('langs', Apiato::call('Localization@GetAllLanguageDBAction', [[['status', '=', BladeHelper::HIEN_THI]]]));
        }

        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            View::share('user', $this->user);

            return $next($request);
        });
    }

    public function showAddForm()
    {
        $this->editMode = false;
        View::share('editMode', $this->editMode);
    }

    public function showEditForm()
    {
        $this->editMode = true;
        View::share('editMode', $this->editMode);
    }

    public function uploadImage(&$tranporter, $request, $field, string $prefix = '', string $folder)
    {
        if (isset($request->$field)) {
            $image = Apiato::call('File@UploadImageAction', [$request, $field, $prefix, $folder]);
            if (!$image['error']) {
                if (is_object($tranporter)) {
                    $tranporter->$field = $image['fileName'];
                } else {
                    $tranporter[$field] = $image['fileName'];
                }
            } else {
                return $image;
            }
        }

        return $tranporter;
    }

    public function uploadMultipleImage(&$tranporter, $request, $field, string $prefix = '', string $folder)
    {
        if (isset($request->$field)) {
            $image = Apiato::call('File@UploadMultipleImageAction', [$request, $field, $prefix, $folder]);
            if (!$image['error']) {
                if (is_object($tranporter)) {
                    $tranporter->$field = json_encode($image['fileName']);
                } else {
                    $tranporter[$field] = json_encode($image['fileName']);
                }
            } else {
                return $image;
            }
        }
        return $tranporter;
    }

    public function notfound($id = 0)
    {
        return redirect()->back()->withErrors(['not_existed' => $this->title . ($id > 0 ? ' có ID: ' . $id : '') . ' đã bị xóa hoặc không tồn tại']);
    }

    public function throwExceptionViaMess(Exception $e)
    {
        return redirect()->back()->withErrors(['not_existed' => $e->getMessage()]);
    }

    public function beforeSave($request, &$tranporter)
    {
        $field = $this->imageField;

        if (!empty($tranporter["delete_{$field}"]) && $tranporter["delete_{$field}"] === '1') {
            $tranporter[$field] = null;
        }

        if (isset($request->$field)) {
            $image = Apiato::call('File@UploadImageAction', [$request, $field, $this->imageKey, $this->imageKey]);
            if (!empty($image) && isset($image['error']) && $image['error']) {
                return redirect()->back()->withInput()->withErrors(['error:' => $image['msg']]);
            }
            $tranporter[$field] = $image['fileName'];
        }

        //upload file
        $fileField = $this->fileField;
        if (isset($request->$fileField)) {
            $file = Apiato::call('File@UploadFilePdfAction', [$request, $fileField, $this->imageKey, $this->imageKey]);
            if (!empty($file) && isset($file['error']) && $file['error']) {
                return redirect()->back()->withInput()->withErrors(['error:' => $file['msg']]);
            }
            $tranporter['file_source'] = $file['filesource'];
            $tranporter['file_name'] = $file['fileName'];
        }


    }

    public function afterSave($request)
    {
        // todo here
    }

    public function save($request)
    {
        try {
            $tranporter = $request->all();

            $this->beforeSave($request, $tranporter);

            $object = Apiato::call($this->actions[$this->editMode ? 'update' : 'create'], [$tranporter]);
            if ($object) {
                $this->afterSave($request);

                $url = $this->editMode ? route($this->routes['edit'] ?? $this->routes['update'], [$object->id]) : route($this->routes['list']);
                $msg = $this->editMode ? 'Cập nhật bản ghi thành công!' : 'Thêm mới bản ghi thành công!';
                return redirect()->to($url)->with('status', $msg);
            }
        } catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error:' => 'Đã xảy ra lỗi! Vui lòng thử lại! ' . $e->getMessage()]);
        }
    }

}
