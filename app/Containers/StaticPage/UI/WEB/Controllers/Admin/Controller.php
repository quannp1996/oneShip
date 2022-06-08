<?php

namespace App\Containers\StaticPage\UI\WEB\Controllers\Admin;

use Apiato\Core\Foundation\Facades\FunctionLib;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\StaticPage\UI\WEB\Requests\GetAllStaticPageRequest;
use App\Containers\StaticPage\UI\WEB\Requests\CreateStaticPageRequest;
use App\Containers\StaticPage\UI\WEB\Requests\UpdateStaticPageRequest;
use App\Containers\StaticPage\UI\WEB\Requests\DeleteStaticPageRequest;
use App\Ship\Parents\Controllers\AdminController;
use Exception;

class Controller extends AdminController
{
    public function __construct()
    {
        $this->title = 'Trang tĩnh';
        $this->imageKey = 'staticpage';
        $this->actions = [
            'update' => 'StaticPage@UpdateStaticPageAction',
            'create' => 'StaticPage@CreateStaticPageAction'
        ];
        $this->routes = [
            'list' => 'admin_staticpage_home_page',
            'update' => 'admin_staticpage_edit_page',
            'create' => 'admin_staticpage_add_page'
        ];

        parent::__construct();
    }

    public function index(GetAllStaticPageRequest $request)
    {
        Apiato::call('BaseContainer@CreateBreadcrumbAction', ['list', $this->title]);
        $options = array_merge(['' => 'Chọn vị trí'], config('page-container.positions'));
        $pages = Apiato::call('StaticPage@ListStaticPageAction', [$request, $this->perPage]);
        return view('staticpage::admin.index', [
            'search_data' => $request,
            'data' => $pages,
            'positions' => $options
        ]);
    }

    public function add(CreateStaticPageRequest $request)
    {
        $this->showAddForm();
        Apiato::call('BaseContainer@CreateBreadcrumbAction', ['add', $this->title]);

        return view('staticpage::admin.edit', [
            'positions' => config('page-container.positions'),
        ]);
    }

    public function create(CreateStaticPageRequest $request)
    {
        return $this->save($request);
    }

    public function edit(UpdateStaticPageRequest $request)
    {
        $this->showEditForm();
        Apiato::call('BaseContainer@CreateBreadcrumbAction', ['edit', $this->title]);

        try {
            $page = Apiato::call('StaticPage@Admin\FindStaticPageByIDAction', [$request->id]);
            return view('staticpage::admin.edit', [
                'data' => $page,
                'positions' => config('page-container.positions'),
            ]);
        } catch (Exception $e) {
            return redirect()->route('admin_staticpage_home_page', ['id' => $request->id])->with('status', 'Có lỗi');
        }
    }

    public function update(UpdateStaticPageRequest $request)
    {
        $this->editMode = true;
        return $this->save($request);
    }

    public function delete(DeleteStaticPageRequest $request)
    {
        try {
            Apiato::call('StaticPage@DeleteStaticPageAction', [$request]);
        } catch (Exception $e) {
            // throw $e;
            return redirect()->back()->withInput()->withErrors(['error:' => 'Có lỗi trong quá trình lưu dữ liệu! Vui lòng thử lại! ' . $e->getMessage()]);
        }
    }

    public function enable(UpdateStaticPageRequest $request)
    {
        try {
            Apiato::call('StaticPage@EnableStaticPageAction', [$request]);
            return FunctionLib::ajaxRespondV2(true, 'Success');
        } catch (Exception $e) {
            // throw $e;
            return redirect()->back()->withInput()->withErrors(['error:' => 'Có lỗi trong quá trình lưu dữ liệu! Vui lòng thử lại! ' . $e->getMessage()]);
        }
    }

    public function disable(UpdateStaticPageRequest $request)
    {
        try {
            Apiato::call('StaticPage@DisableStaticPageAction', [$request]);
            return FunctionLib::ajaxRespondV2(true, 'Success');
        } catch (Exception $e) {
            // throw $e;
            return redirect()->back()->withInput()->withErrors(['error:' => 'Có lỗi trong quá trình lưu dữ liệu! Vui lòng thử lại! ' . $e->getMessage()]);
        }
    }

    public function save($request){
        try {
            $tranporter = $request->all();
            $this->beforeSave($request, $tranporter);
            $object = Apiato::call($this->actions[$this->editMode ? 'update' : 'create'], [$tranporter, $request]);
            if($object){
                $this->afterSave($request);
                $url = $this->editMode ? route($this->routes['update'], ['id' => $object->id]) : route($this->routes['list']);
                $msg = $this->editMode ? 'Cập nhật '.$this->title.' thành công' : $this->title.' đã được thêm mới';
                return redirect()->to($url)->with('status', $msg);
            }
        } catch (\Exception $e) {
            // throw $e;
            return redirect()->back()->withInput()->withErrors(['error:' => 'Có lỗi trong quá trình lưu dữ liệu! Vui lòng thử lại! ' . $e->getMessage()]);
        }
    }

    public function beforeSave($request, &$tranporter)
    {
        if($request->hasFile('images')){
            $this->uploadMultipleImage($tranporter, $request, 'images', 'doitac', 'staticpage');
        }else{
            $tranporter['images'] = $request->get('old_images', []);
        }

        if($request->hasFile('image_seo')){
            $this->uploadImage($tranporter, $request, 'image_seo', 'seo', 'staticpage');
        }else{
            $tranporter['image_seo'] = $request->get('old_seo', []);
        }

        parent::beforeSave($request, $tranporter);
    }
}
