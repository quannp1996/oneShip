<?php
/**
 * Created by PhpStorm.
 * Filename: HasManyKeyBy.php
 * User: Oops!Memory - OopsMemory.com
 * Date: 7/22/20
 * Time: 14:42
 */

namespace Apiato\Core\Traits;

use App\Ship\core\Traits\HelpersTraits\HasManyKeyBy as HelpersTraitsHasManyKeyBy;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManyKeyBy
{
    /**
     * @param $keyBy
     * @param $related
     * @param null $foreignKey
     * @param null $localKey
     * @return HasMany
     */
    protected function hasManyKeyBy($keyBy, $related, $foreignKey = null, $localKey = null)
    {
        // copied from \Illuminate\Database\Eloquent\Concerns\HasRelationships::hasMany

        $instance = $this->newRelatedInstance($related);
        $foreignKey = $foreignKey ?: $this->getForeignKey();
        $localKey = $localKey ?: $this->getKeyName();

        return new HelpersTraitsHasManyKeyBy($keyBy, $instance->newQuery(),
            $this, $instance->getTable().'.'.$foreignKey, $localKey);
    }
}