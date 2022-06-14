<?php

namespace App\Containers\Location\UI\WEB\Controllers\Admin;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Controllers\AdminController;
use App\Containers\Location\UI\WEB\Requests\CreateLocationRequest;
use App\Containers\Location\UI\WEB\Requests\DeleteLocationRequest;
use App\Containers\Location\UI\WEB\Requests\GetAllLocationsRequest;
use App\Containers\Location\UI\WEB\Requests\FindLocationByIdRequest;
use App\Containers\Location\UI\WEB\Requests\UpdateLocationRequest;
use App\Containers\Location\UI\WEB\Requests\StoreLocationRequest;
use App\Containers\Location\UI\WEB\Requests\EditLocationRequest;
use App\Containers\Location\UI\WEB\Requests\GetAllWardRequest;
use App\Ship\core\Traits\HelpersTraits\ApiResTrait;

/**
 * Class Controller
 *
 * @package App\Containers\Location\UI\WEB\Controllers
 */
class WardController extends AdminController
{
    use ApiResTrait;

    public function __construct()
    {
        $this->title = __('location::admin.ward.title');
        parent:: __construct();
    }
    /**
     * Show all entities
     *
     * @param GetAllLocationsRequest $request
     */
    public function listWard(GetAllWardRequest $request)
    {
        Apiato::call('BaseContainer@CreateBreadcrumbAction', ['list', $this->title]);
        $wards = Apiato::call('Location@GetAllWardsAction', [true,20,'name asc', ['district', 'province']]);
        return view('location::Admin.ward', [
            'wards' => $wards,
            'search_data' => $request
        ]);
    }

    /**
     * Show one entity
     *
     * @param FindLocationByIdRequest $request
     */
    public function editWard(FindLocationByIdRequest $request)
    {
        Apiato::call('BaseContainer@CreateBreadcrumbAction', ['edit', $this->title, 'location.ward_list']);
        $ward = Apiato::call('Location@FindWardByIdTask',[$request->id]);
        $cities = Apiato::call('Location@GetAllCitiesAction', [false]);
        $district = [];
        if(isset($ward->district->province_id)) {
            $district = Apiato::call('Location@GetDistrictByCityAction', [$ward->district->province_id]);
        }
        return view('location::admin.ward_edit', [
            'ward' => $ward,
            'cities' => $cities,
            'districts' => $district
        ]);
    }

    /**
     * Create entity (show UI)
     *
     * @param CreateLocationRequest $request
     */
    public function create(CreateLocationRequest $request)
    {
        // ..
    }

    /**
     * Add a new entity
     *
     * @param StoreLocationRequest $request
     */
    public function store(StoreLocationRequest $request)
    {
        $location = Apiato::call('Location@CreateLocationAction', [$request]);

        // ..
    }

    /**
     * Edit entity (show UI)
     *
     * @param EditLocationRequest $request
     */
    public function edit(EditLocationRequest $request)
    {
        $location = Apiato::call('Location@GetLocationByIdAction', [$request]);

        // ..
    }

    /**
     * Update a given entity
     *
     * @param UpdateLocationRequest $request
     */
    public function updateWard(UpdateLocationRequest $request)
    {
        $ward = Apiato::call('Location@UpdateWardAction', [$request, [
            'task' => 'Location@UpdateWardTask'
        ]]);
        return redirect(route('location.ward_list'));
    }

    /**
     * Delete a given entity
     *
     * @param DeleteLocationRequest $request
     */
    public function delete(DeleteLocationRequest $request)
    {
         $result = Apiato::call('Location@DeleteLocationAction', [$request]);
    }

    public function getWardByDistrict(GetAllWardRequest $request)
    {
        $wards = Apiato::call('Location@GetAllWardsAction', [false,20,'name asc', [], [
            'district_id' =>  $request->district_id
        ]]);
        return $this->sendResponse($wards);
    }
}
