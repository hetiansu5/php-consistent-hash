<?php
namespace ConsistentHash;

/**
 * Hash算法
 */
class Hash
{

    /**
     * crc32算法，兼容32bit系统
     *
     * @param $str
     * @return int
     */
    public static function crc32($str)
    {
        return intval(sprintf("%u\n", crc32($str)));
    }

}