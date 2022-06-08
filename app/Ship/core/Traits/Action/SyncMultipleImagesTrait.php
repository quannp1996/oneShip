<?php

namespace Apiato\Core\Traits\Action;


trait SyncMultipleImagesTrait
{
    public function syncImage(int $objectID, array $newImage = [], array $oldImage = []){
        if(
            !empty($this->primaryKey) &&
            !empty($this->imageKey) &&
            !empty($this->syncImageClass) &&
            class_exists($this->syncImageClass)
        ){
            
            $insertData = [];
            foreach(array_merge($newImage, $oldImage) AS $image){
                $insertData[] = [
                    $this->primaryKey =>$objectID,
                    $this->imageKey => $image
                ];
            }
            app($this->syncImageClass)->run($insertData, $objectID);
        }
    }
}
