<?php

namespace App\Containers\Field\UI\WEB\Controllers\Admin;

use App\Containers\Field\UI\WEB\Requests\CreateFieldRequest;
use App\Containers\Field\UI\WEB\Requests\DeleteFieldRequest;
use App\Containers\Field\UI\WEB\Requests\GetAllFieldsRequest;
use App\Containers\Field\UI\WEB\Requests\FindFieldByIdRequest;
use App\Containers\Field\UI\WEB\Requests\UpdateFieldRequest;
use App\Containers\Field\UI\WEB\Requests\StoreFieldRequest;
use App\Containers\Field\UI\WEB\Requests\EditFieldRequest;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\BaseContainer\Actions\CreateBreadcrumbAction;
use App\Ship\Parents\Controllers\AdminController;
use Illuminate\Support\Facades\DB;

/**
 * Class Controller
 *
 * @package App\Containers\Field\UI\WEB\Controllers
 */
class Controller extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->title = 'Trường mở rộng';
    }
    /**
     * Show all entities
     *
     * @param GetAllFieldsRequest $request
     */
    public function index(GetAllFieldsRequest $request)
    {
        app(CreateBreadcrumbAction::class)->run('list', $this->title);
        $fields = Apiato::call('Field@GetAllFieldsAction', [$request->all()]);
        return view('field::admin.index', [
            'data' => $fields,
            'search_data' => $request
        ]);
    }

    /**
     * Show one entity
     *
     * @param FindFieldByIdRequest $request
     */
    public function show(FindFieldByIdRequest $request)
    {
        $field = Apiato::call('Field@FindFieldByIdAction', [$request]);
    }

    /**
     * Create entity (show UI)
     *
     * @param CreateFieldRequest $request
     */
    public function create(CreateFieldRequest $request)
    {
        app(CreateBreadcrumbAction::class)->run('add', $this->title, 'admin_field_home_page');
        return view('field::admin.edit');
    }

    /**
     * Add a new entity
     *
     * @param StoreFieldRequest $request
     */
    public function store(StoreFieldRequest $request)
    {
        $field = Apiato::call('Field@CreateFieldAction', [$request]);
        return redirect()->to(route('admin_field_home_page'));
    }

    /**
     * Edit entity (show UI)
     *
     * @param EditFieldRequest $request
     */
    public function edit(EditFieldRequest $request)
    {
        $field = Apiato::call('Field@FindFieldByIdAction', [$request]);
        return view('field::admin.edit', [
            'data' => $field
        ]);
    }

    /**
     * Update a given entity
     *
     * @param UpdateFieldRequest $request
     */
    public function update(UpdateFieldRequest $request)
    {
        $field = Apiato::call('Field@UpdateFieldAction', [$request]);
        return redirect()->to(route('admin_field_home_page'));
    }

    /**
     * Delete a given entity
     *
     * @param DeleteFieldRequest $request
     */
    public function delete(DeleteFieldRequest $request)
    {
         $result = Apiato::call('Field@DeleteFieldAction', [$request]);
    }
}
