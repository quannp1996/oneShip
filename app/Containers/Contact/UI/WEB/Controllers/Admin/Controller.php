<?php

namespace App\Containers\Contact\UI\WEB\Controllers\Admin;

use App\Containers\Contact\UI\WEB\Requests\CreateContactRequest;
use App\Containers\Contact\UI\WEB\Requests\DeleteContactRequest;
use App\Containers\Contact\UI\WEB\Requests\GetAllContactsRequest;
use App\Containers\Contact\UI\WEB\Requests\FindContactByIdRequest;
use App\Containers\Contact\UI\WEB\Requests\UpdateContactRequest;
use App\Containers\Contact\UI\WEB\Requests\StoreContactRequest;
use App\Containers\Contact\UI\WEB\Requests\EditContactRequest;
use App\Ship\Parents\Controllers\AdminController;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\BaseContainer\Actions\CreateBreadcrumbAction;
use App\Containers\Contact\Excel\ContactExport;
use App\Containers\Field\Actions\GetAllFieldsAction;
use Exception;

/**
 * Class Controller
 *
 * @package App\Containers\Contact\UI\WEB\Controllers
 */
class Controller extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->title = 'Liên hệ';
        view()->share('site_title', $this->title);
    }
    /**
     * Show all entities
     *
     * @param GetAllContactsRequest $request
     */
    public function index(GetAllContactsRequest $request)
    {
        app(CreateBreadcrumbAction::class)->run('list', $this->title);
        $contacts = Apiato::call('Contact@GetAllContactsAction', [$request]);
        $fields = app(GetAllFieldsAction::class)->run();
        return view('contact::admin.index', [
            'data' => $contacts,
            'search_data' => $request,
            'fields' => $fields
        ]);
    }

    /**
     * Show one entity
     *
     * @param FindContactByIdRequest $request
     */
    public function show(FindContactByIdRequest $request)
    {
        $contact = Apiato::call('Contact@FindContactByIdAction', [$request]);
    }

    /**
     * Create entity (show UI)
     *
     * @param CreateContactRequest $request
     */
    public function create(CreateContactRequest $request)
    {
        // ..
    }

    /**
     * Add a new entity
     *
     * @param StoreContactRequest $request
     */
    public function store(StoreContactRequest $request)
    {
        $contact = Apiato::call('Contact@CreateContactAction', [$request]);
    }

    /**
     * Edit entity (show UI)
     *
     * @param EditContactRequest $request
     */
    public function edit(EditContactRequest $request)
    {
        $contact = Apiato::call('Contact@GetContactByIdAction', [$request]);
    }

    /**
     * Update a given entity
     *
     * @param UpdateContactRequest $request
     */
    public function update(UpdateContactRequest $request)
    {
        $contact = Apiato::call('Contact@UpdateContactAction', [$request]);
    }

    /**
     * Delete a given entity
     *
     * @param DeleteContactRequest $request
     */
    public function delete(DeleteContactRequest $request)
    {
         $result = Apiato::call('Contact@DeleteContactAction', [$request]);
    }

    public function export(){
        try{
            return \Excel::download(new ContactExport(), 'contact.xlsx');
        }catch(Exception $e){
            return redirect(route('admin_contact_home_page'));
        }
    }
}
