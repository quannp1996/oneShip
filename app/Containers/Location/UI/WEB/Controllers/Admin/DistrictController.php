<?php

namespace App\Containers\Location\UI\WEB\Controllers\Admin;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Controllers\AdminController;
use App\Containers\Location\UI\WEB\Requests\DeleteLocationRequest;
use App\Containers\Location\UI\WEB\Requests\GetAllLocationsRequest;
use App\Containers\Location\UI\WEB\Requests\UpdateLocationRequest;
use App\Containers\Location\UI\WEB\Requests\StoreLocationRequest;
use App\Containers\Location\UI\WEB\Requests\StoreDistrictRequest;
use App\Containers\Location\UI\WEB\Requests\UpdateDistrictRequest;
use App\Ship\core\Traits\HelpersTraits\ApiResTrait;
use Illuminate\Support\Facades\DB;

/**
 * Class Controller
 *
 * @package App\Containers\Location\UI\WEB\Controllers
 */
class DistrictController extends LocationController
{
    use ApiResTrait;

    public function __construct()
    {
        $this->title = __('location::admin.district.title');
        parent:: __construct();
    }

    /**
     * Show all entities
     *
     * @param GetAllLocationsRequest $request
     */
    public function listDistrict(GetAllLocationsRequest $request)
    {
        Apiato::call('BaseContainer@CreateBreadcrumbAction', ['list', $this->title]);
        $districts = Apiato::call('Location@GetAllDistrictsAction', [true, 20, 'id desc', ['city'], $request->all()]);
        $cities = Apiato::call('Location@GetAllCitiesAction', [false]);
        return view('location::Admin.district', [
            'districts' => $districts,
            'cities' => $cities,
            'search_data' => $request
        ]);
    }

    /**
     * Add a new entity
     *
     * @param StoreLocationRequest $request
     */
    public function storeDistrict(StoreDistrictRequest $request)
    {
        Apiato::call('Location@CreateDistrictAction', [$request]);
        return redirect(route('location.district_list'));
    }

    /**
     * Update a given entity
     *
     * @param UpdateLocationRequest $request
     */
    public function updateDistrict(UpdateDistrictRequest $request)
    {
        Apiato::call('Location@UpdateDistrictAction', [$request]);
        return redirect(route('location.district_list'));
    }

    /**
     * Delete a given entity
     *
     * @param DeleteLocationRequest $request
     */
    public function deleteDistrict(DeleteLocationRequest $request)
    {
        Apiato::call('Location@DeleteDistrictAction', [$request->id]);
        return redirect(route('location.district_list'));
    }

    /**
     * Get List District By City ID
     *
     * @param GetAllLocationsRequest $request
     */
    public function getDistrictByCity(GetAllLocationsRequest $request)
    {
         $districts = Apiato::call('Location@GetAllDistrictsAction', [ false,20,'name asc', [], [
             'province_id' => $request->province_id
         ]]);
         return $this->sendResponse([
             'firstOption' => "<option value=''>".__('location::admin.district.first_optionv2')."</option>",
             'districts' => $districts
         ]);
    }
}
