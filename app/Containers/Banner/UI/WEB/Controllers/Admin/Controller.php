<?php

namespace App\Containers\Banner\UI\WEB\Controllers\Admin;

use Apiato\Core\Foundation\Facades\FunctionLib;
use Apiato\Core\Foundation\Facades\Apiato;
use Apiato\Core\Foundation\StringLib;
use App\Containers\Banner\Enums\BannerType;
use App\Containers\Banner\Models\Banner;
use App\Containers\Banner\UI\WEB\Requests\Admin\FindBannerRequest;
use App\Containers\Banner\UI\WEB\Requests\CreateBannerRequest;
use App\Containers\Banner\UI\WEB\Requests\GetAllBannerRequest;
use App\Containers\Banner\UI\WEB\Requests\UpdateBannerRequest;
use App\Containers\Category\Actions\Admin\GetAllCategoriesAction;
use App\Ship\Parents\Controllers\AdminController;
use Exception;

class Controller extends AdminController
{
    public function __construct()
    {
        $this->title = 'Banner';

        parent::__construct();
        
    }
    /**
     * @return  \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(GetAllBannerRequest $request)
    {
        Apiato::call('BaseContainer@CreateBreadcrumbAction', ['list', $this->title]);

        $banners = Apiato::call('Banner@BannerListingAction', [$request, $this->perPage]);
        $options = array_merge(['' => 'Chọn vị trí'], config('banner-container.positions'));

        return view('banner::admin.index', [
            'search_data' => $request,
            'data' => $banners,
            'positions' => $options
        ]);
    }

    public function edit(FindBannerRequest $request)
    {
        $this->showEditForm();
        Apiato::call('BaseContainer@CreateBreadcrumbAction', ['edit', $this->title, 'admin_banner_home_page']);

        try{
            $banner = Apiato::call('Banner@Admin\FindBannerByIdAction', [$request->id]);
        }catch(Exception $e){
            return redirect()->route('admin_banner_home_page', ['id' => $request->id])->with('status', 'Có lỗi');
        }

        return view('banner::admin.edit', [
            'data' => $banner,
            'positions' => config('banner-container.positions')
        ]);

        return $this->notfound($request->id);
    }

    public function add()
    {
        $this->showAddForm();
        Apiato::call('BaseContainer@CreateBreadcrumbAction', ['add', $this->title, 'admin_banner_home_page']);

        return view('banner::admin.edit', [
            'positions' => config('banner-container.positions')
        ]);
    }

    public function update(UpdateBannerRequest $request)
    {
        try {
            $data =$request->except('image');
            
            if(isset($request['delete_image'])){
                $data['image'] = '' ;
            }

            if (isset($request->image)) {
                $image = Apiato::call('File@UploadImageAction', [$request, 'image', 'banner', StringLib::getClassNameFromString(Banner::class)]);
                if (!$image['error']) {
                    $data['image'] = $image['fileName'];
                }
            }

            $banner = Apiato::call('Banner@UpdateBannerAction', [$data]);

            if ($banner) {
                return redirect()->route('admin_banners_edit_page', ['id' => $banner->id])->with('status', 'Cập nhật banner thành công');
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
            $this->throwExceptionViaMess($e);
        }
    }

    public function create(CreateBannerRequest $request)
    {
        try {
            $data =$request->except('image');

            if (isset($request->image)) {
                $image = Apiato::call('File@UploadImageAction', [$request, 'image', 'banner', StringLib::getClassNameFromString(Banner::class)]);
                if (!$image['error']) {
                    $data['image'] = $image['fileName'];
                }
            }

            $banner = Apiato::call('Banner@CreateBannerAction', [$data]);
            if ($banner) {
                return redirect()->route('admin_banner_home_page')->with('status', 'Banner đã được thêm mới');
            }
        } catch (\Exception $e) {
            // throw $e;
            $this->throwExceptionViaMess($e);
        }
    }

    public function delete(FindBannerRequest $request)
    {
        try {
            Apiato::call('Banner@DeleteBannerAction', [$request]);
        } catch (\Exception $e) {
            // throw $e;
            $this->throwExceptionViaMess($e);
        }
    }

    public function enable(FindBannerRequest $request){
        try {
            Apiato::call('Banner@EnableBannerAction', [$request]);
            return FunctionLib::ajaxRespondV2(true,'Success');
        } catch (\Exception $e) {
            // throw $e;
            $this->throwExceptionViaMess($e);
        }
    }

    public function disable(FindBannerRequest $request){
        try {
            Apiato::call('Banner@DisableBannerAction', [$request]);
            return FunctionLib::ajaxRespondV2(true,'Success');
        } catch (\Exception $e) {
            // throw $e;
            $this->throwExceptionViaMess($e);
        }
    }
}
