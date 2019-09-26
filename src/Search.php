<?php
namespace ConsistentHash;

class Search
{

    /**
     * 二分查找
     *
     * @param array $array
     * @param int $value
     * @return int
     */
    public static function binarySearch($array, $value)
    {
        $count = count($array);
        $left = 0;
        $right = $count - 1;
        if ($value <= $array[$left]) {
            return $left;
        } else if ($value >= $array[$right]) {
            return $right;
        }

        while (true) {
            $middle = intval(floor(($right - $left) / 2)) + $left;
            if ($middle == $left) {
                if ($value > $array[$left]) {
                    return $right;
                } else {
                    return $left;
                }
            }

            if ($array[$middle] == $value) {
                return $middle;
            } else if ($value > $array[$middle]) {
                $left = $middle;
            } else {
                $right = $middle;
            }
        }
    }

}