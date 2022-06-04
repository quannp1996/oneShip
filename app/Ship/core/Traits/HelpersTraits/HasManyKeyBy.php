<?php
/**
 * Created by PhpStorm.
 * Filename: HasManyKeyBy.php
 * User: Oops!Memory - OopsMemory.com
 * Date: 7/22/20
 * Time: 14:41
 */

namespace App\Ship\core\Traits\HelpersTraits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HasManyKeyBy extends HasMany
{
    private $keyBy;

    public function __construct($keyBy, Builder $query, Model $parent, string $foreignKey, string $localKey)
    {
        $this->keyBy = $keyBy;
        parent::__construct($query, $parent, $foreignKey, $localKey);
    }

    public function getResults()
    {
        return parent::getResults()->keyBy($this->keyBy);
    }

    protected function getRelationValue(array $dictionary, $key, $type)
    {
        return parent::getRelationValue($dictionary, $key, $type)->keyBy($this->keyBy);
    }
}