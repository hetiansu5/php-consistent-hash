<?php

use ConsistentHash\Search;
use PHPUnit\Framework\TestCase;

class SearchTest extends TestCase
{

    public function testBinarySearch()
    {
        $arr = [
            1, 3, 3, 4, 5, 9, 12, 39
        ];

        $value = -1;
        $pos = Search::binarySearch($arr, $value);
        $this->assertSame(0, $pos);

        $value = 91;
        $pos = Search::binarySearch($arr, $value);
        $this->assertSame(7, $pos);

        $value = 4.5;
        $pos = Search::binarySearch($arr, $value);
        $this->assertSame(4, $pos);

        $value = 4;
        $pos = Search::binarySearch($arr, $value);
        $this->assertSame(3, $pos);

        $value = 3;
        $pos = Search::binarySearch($arr, $value);
        $this->assertSame(1, $pos);
    }

}