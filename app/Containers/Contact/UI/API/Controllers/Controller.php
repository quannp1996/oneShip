<?php

namespace App\Containers\Contact\UI\API\Controllers;

use App\Containers\Contact\UI\API\Requests\CreateContactRequest;
use App\Containers\Contact\UI\API\Requests\DeleteContactRequest;
use App\Containers\Contact\UI\API\Requests\GetAllContactsRequest;
use App\Containers\Contact\UI\API\Requests\FindContactByIdRequest;
use App\Containers\Contact\UI\API\Requests\UpdateContactRequest;
use App\Containers\Contact\UI\API\Transformers\ContactTransformer;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\BaseContainer\UI\WEB\Controllers\BaseApiFrontController;
use App\Containers\Contact\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

/**
 * Class Controller
 *
 * @package App\Containers\Contact\UI\API\Controllers
 */
class Controller extends BaseApiFrontController
{
    /**
     * @param CreateContactRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createContact(CreateContactRequest $request)
    {
        $ccEmail = (!empty($this->settings['contact']['cc_email'])) ? explode(',',  $this->settings['contact']['cc_email']) : [];
        $contact = Apiato::call('Contact@CreateContactAction', [$request]);
        Mail::to($this->settings['contact']['email'])->cc($ccEmail)->send( new ContactMail($contact));
        return $this->sendResponse($contact, 'Thông tin đã được gửi tới ban quản trị');
    }

    /**
     * @param FindContactByIdRequest $request
     * @return array
     */
    public function findContactById(FindContactByIdRequest $request)
    {
        $contact = Apiato::call('Contact@FindContactByIdAction', [$request]);

        return $this->transform($contact, ContactTransformer::class);
    }

    /**
     * @param GetAllContactsRequest $request
     * @return array
     */
    public function getAllContacts(GetAllContactsRequest $request)
    {
        $contacts = Apiato::call('Contact@GetAllContactsAction', [$request]);

        return $this->transform($contacts, ContactTransformer::class);
    }

    /**
     * @param UpdateContactRequest $request
     * @return array
     */
    public function updateContact(UpdateContactRequest $request)
    {
        $contact = Apiato::call('Contact@UpdateContactAction', [$request]);

        return $this->transform($contact, ContactTransformer::class);
    }

    /**
     * @param DeleteContactRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteContact(DeleteContactRequest $request)
    {
        Apiato::call('Contact@DeleteContactAction', [$request]);

        return $this->noContent();
    }
}
