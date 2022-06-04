<?php
/**
 * Created by PhpStorm.
 * Filename: HasManyKeyBy.php
 * User: Oops!Memory - OopsMemory.com
 * Date: 7/22/20
 * Time: 14:42
 */

namespace Apiato\Core\Traits;

use App\Containers\Localization\Actions\GetCurrentLangAction;

trait DescriptionTrait
{
    public $localKey = 'id';
    
    public function all_desc(){
        return $this->hasManyKeyBy('language_id', $this->related, $this->foreinKey, $this->localKey);
    }

    public function desc(){
        $language = app(GetCurrentLangAction::class)->run();
        return $this->hasOne($this->related, $this->foreinKey, $this->localKey)->where('language_id', $language->language_id);
    }
}