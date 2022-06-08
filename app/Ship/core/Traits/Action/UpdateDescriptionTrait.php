<?php

namespace Apiato\Core\Traits\Action;


trait UpdateDescriptionTrait
{
    public function syncDesc(int $objectID, $request){
        if(
            !empty($this->descriptionField) &&
            !empty($this->columKey) &&
            !empty($this->syncClass) &&
            class_exists($this->syncClass)
        ){
            $descriptions = (is_array($request) && !empty($request[$this->descriptionField])) ? $request[$this->descriptionField] : [];  
            if($objectID && !empty($descriptions)){
                foreach($descriptions AS $key => &$description){
                    $description['language_id'] = $key;
                    $description[$this->columKey] = $objectID;
                }
                app($this->syncClass)->run($descriptions, $objectID);
            }
        }
    }
}
