<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-04 22:17:03
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-08-08 22:26:40
 * @ Description: Happy Coding!
 */

namespace App\Containers\BaseContainer\Enums;

use App\Containers\BaseContainer\Exceptions\CannotInitClassException;
use ReflectionClass;

abstract class BaseEnum
{
    const ZERO = 0;
    const NOT_DELETED = 0;
    const DELETE = -1;
    const ACTIVE = '2';
    const DE_ACTIVE = 1;

    private static $constCacheArray = NULL;

    final private function __construct()
    {
        throw new CannotInitClassException(); // 
    }

    private static function getConstants()
    {
        if (self::$constCacheArray == NULL) {
            self::$constCacheArray = [];
        }
        $calledClass = get_called_class();
        if (!array_key_exists($calledClass, self::$constCacheArray)) {
            $reflect = new ReflectionClass($calledClass);
            self::$constCacheArray[$calledClass] = $reflect->getConstants();
        }
        return self::$constCacheArray[$calledClass];
    }

    public static function isValidName($name, $strict = false)
    {
        $constants = self::getConstants();

        if ($strict) {
            return array_key_exists($name, $constants);
        }

        $keys = array_map('strtolower', array_keys($constants));
        return in_array(strtolower($name), $keys);
    }

    public static function isValidValue($value, $strict = true)
    {
        $values = array_values(self::getConstants());
        return in_array($value, $values, $strict);
    }

    final private function __clone()
    {
        throw new CannotInitClassException();
    }

    final public static function toArray()
    {
        return (new ReflectionClass(static::class))->getConstants();
    }

    final public static function isValid($value)
    {
        return in_array($value, static::toArray());
    }
}
