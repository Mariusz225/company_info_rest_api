<?php

namespace App\Helper;

class ArrayHelper
{
    /**
     * Checks if all elements from the source array are mapped as keys in the target array.
     *
     * @param array $sourceArray The source array to check for elements.
     * @param array $targetArray The target array to compare against.
     *
     * @return bool True if all elements in the source array are keys in the target array, false otherwise.
     */
    public static function areAllElementsMappedInKeys(array $sourceArray, array $targetArray): bool
    {
        foreach ($sourceArray as $element) {
            if (!array_key_exists($element, $targetArray)) {
                return false;
            }
        }
        return true;
    }
}
