<?php

namespace App\Containers\Field\UI\API\Controllers;

use App\Containers\Field\UI\API\Requests\CreateFieldRequest;
use App\Containers\Field\UI\API\Requests\DeleteFieldRequest;
use App\Containers\Field\UI\API\Requests\GetAllFieldsRequest;
use App\Containers\Field\UI\API\Requests\FindFieldByIdRequest;
use App\Containers\Field\UI\API\Requests\UpdateFieldRequest;
use App\Containers\Field\UI\API\Transformers\FieldTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class Controller
 *
 * @package App\Containers\Field\UI\API\Controllers
 */
class Controller extends ApiController
{
    /**
     * @param CreateFieldRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createField(CreateFieldRequest $request)
    {
        $field = Apiato::call('Field@CreateFieldAction', [$request]);

        return $this->created($this->transform($field, FieldTransformer::class));
    }

    /**
     * @param FindFieldByIdRequest $request
     * @return array
     */
    public function findFieldById(FindFieldByIdRequest $request)
    {
        $field = Apiato::call('Field@FindFieldByIdAction', [$request]);

        return $this->transform($field, FieldTransformer::class);
    }

    /**
     * @param GetAllFieldsRequest $request
     * @return array
     */
    public function getAllFields(GetAllFieldsRequest $request)
    {
        $fields = Apiato::call('Field@GetAllFieldsAction', [$request]);

        return $this->transform($fields, FieldTransformer::class);
    }

    /**
     * @param UpdateFieldRequest $request
     * @return array
     */
    public function updateField(UpdateFieldRequest $request)
    {
        $field = Apiato::call('Field@UpdateFieldAction', [$request]);

        return $this->transform($field, FieldTransformer::class);
    }

    /**
     * @param DeleteFieldRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteField(DeleteFieldRequest $request)
    {
        Apiato::call('Field@DeleteFieldAction', [$request]);

        return $this->noContent();
    }
}
