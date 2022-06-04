<?php

namespace App\Ship\Parents\Values;

use Apiato\Core\Abstracts\Values\Value as AbstractValue;
use Apiato\Core\Traits\HasResourceKeyTrait;

/**
 * Class BaseValue.
 *
 * @author  Phuong Huu  
 */
class BaseValue extends AbstractValue
{
    public $endPoint;

    public $currentObjectAuthen;

    public $request; 

    public $response;

    public $source; 

    public function __construct(string $endPoint, $currentObjectAuthen, array $request, array $response, string $source='mail')
    {
        $this->endPoint = $endPoint;
        $this->currentObjectAuthen = $currentObjectAuthen;
        $this->request = $request;
        $this->response = $response;
        $this->source = $source;
    }
    
    public function toArray() {
        return [
            'end_point' => $this->endPoint,
            'current_object_authen' => $this->currentObjectAuthen,
            'request' => $this->request,
            'response' => $this->response,
            'source' => $this->source
        ];
    }
}
